<?php

namespace App\Repositories\Frontend\Blogs;

use Image;
use ImageResize;
use Carbon\Carbon;
use App\Models\Blogs\Blog;
use Illuminate\Support\Str;
use App\Models\BlogTags\BlogTag;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Models\BlogImages\BlogImage;
use App\Models\BlogVideos\BlogVideo;
use App\Repositories\BaseRepository;
use App\Models\BlogMapTags\BlogMapTag;
use App\Models\BlogPrivacy\BlogPrivacy;
use Illuminate\Support\Facades\Storage;
use App\Events\Backend\Blogs\BlogCreated;
use App\Events\Backend\Blogs\BlogDeleted;
use App\Events\Backend\Blogs\BlogUpdated;
use App\Models\BlogDesignPanels\BlogDesignPanel;

/**
 * Class BlogsRepository.
 */
class BlogsRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Blog::class;

    protected $upload_path;

    /**
     * Storage Class Object.
     *
     * @var \Illuminate\Support\Facades\Storage
     */
    protected $storage;

    public function __construct()
    {
        $this->upload_path = 'img'.DIRECTORY_SEPARATOR.'blog'.DIRECTORY_SEPARATOR;
        $this->storage = Storage::disk('public');
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->leftjoin(config('access.users_table'), config('access.users_table').'.id', '=', config('module.blogs.table').'.created_by')
            ->select([
                config('module.blogs.table').'.id',
                config('module.blogs.table').'.name',
                config('module.blogs.table').'.publish_datetime',
                config('module.blogs.table').'.status',
                config('module.blogs.table').'.created_by',
                config('module.blogs.table').'.created_at',
                config('access.users_table').'.first_name as user_name',
            ]);
    }

    /**
     * @param array $input
     *
     * @throws \App\Exceptions\GeneralException
     *
     * @return bool
     */
    public function create(array $input)
    {
        // dd($input);
        $tagsArray = $this->createTags($input['tags']);
        unset($input['tags']);
        
        DB::beginTransaction();
        $input['content'] = $this->replaceContentFileLocation($input['content']);
        $input['slug'] = Str::slug($input['name']);
        $input['publish_datetime'] = ($input['status'] == 'Published' ? Carbon::now() : null);
        $input['created_by'] = $input['user_id'];
        if(isset($input['privacy'])){
            $input['shareable'] = 0;
        }
        else{
            $input['shareable'] = 1;
        }
        if($input['edited_featured_image']) {
            $input['featured_image'] = $this->uploadEditedImage($input['edited_featured_image']);
        } else if(array_key_exists('featured_image', $input)) {
            $input['featured_image'] = $this->uploadImage($input['featured_image']);
        }
        
        if ($blog = Blog::create($input)) {
            // Inserting associated tag's id in mapper table
            if (count($tagsArray)) {
                $blog->tags()->sync($tagsArray);
            }

            // Inserting videos
            if(array_key_exists('videos', $input)) {
                $this->addVideos($blog->id, $input['videos']);
            }

            // Save privacy settings
            $groups = explode(',', $input['privacy']);
            $this->setPrivacy($blog->id, 'regular', $groups);

            if($input['attachments'] != '[]') {
                $formatted_attachments = str_replace( array( '\'', '"', ';', '[', ']' ), '', $input['attachments']);
                $formatted_attachments = explode(',', $formatted_attachments);
                $this->backupBlogAttachments($formatted_attachments, $blog->id);

                if($blog->status == 'Published') {
                    $this->deleteTrixAttachments($formatted_attachments);
                }
            }

            event(new BlogCreated($blog));
            DB::commit();
            return $blog;
        }

        throw new GeneralException(trans('exceptions.backend.blogs.create_error'));
    }

    /**
     * Update Blog.
     *
     * @param \App\Models\Blogs\Blog $blog
     * @param array                  $input
     */
    public function update(Blog $blog, array $input)
    {
        $tagsArray = $this->createTags($input['tags']);
        unset($input['tags']);

        DB::beginTransaction();
        $input['content'] = $this->replaceContentFileLocation($input['content']);
        $input['slug'] = Str::slug($input['name']);

        if($input['status'] != 'Unpublished') {
            $input['publish_datetime'] = ($input['status'] == 'Published' ? Carbon::now() : null);
        }
        
        $input['updated_by'] = access()->user()->id;
        if(isset($input['privacy'])){
            $input['shareable'] = 0;
        }
        else{
            $input['shareable'] = 1;
        }
        // Uploading Image
        if($input['edited_featured_image']) {
            $this->deleteOldFile($blog);
            $input['featured_image'] = $this->uploadEditedImage($input['edited_featured_image']);
        } else if (array_key_exists('featured_image', $input)) {
            $this->deleteOldFile($blog);
            $input['featured_image'] = $this->uploadImage($input['featured_image']);
        }
        

        if ($blog->update($input)) {

            // Updating associated tag's id in mapper table
            if (count($tagsArray)) {
                $blog->tags()->sync($tagsArray);
            }

            // Inserting videos
            if(array_key_exists('videos', $input)) {
                $this->addVideos($blog->id, $input['videos']);
            }

            // Save privacy settings
            $groups = explode(',', $input['privacy']);
            $this->setPrivacy($blog->id, 'regular', $groups);

            if($input['attachments'] != '[]') {
                $formatted_attachments = str_replace( array( '\'', '"', ';', '[', ']' ), '', $input['attachments']);
                $formatted_attachments = explode(',', $formatted_attachments);
                $this->backupBlogAttachments($formatted_attachments, $blog->id);

                if($blog->status == 'Published') {
                    $this->deleteTrixAttachments($formatted_attachments);
                }
            }

            event(new BlogUpdated($blog));
            DB::commit();
            return $blog;
        }

        throw new GeneralException(
            trans('exceptions.backend.blogs.update_error')
        );
    }

    /**
     * Creating Tags.
     *
     * @param array $tags
     *
     * @return array
     */
    public function createTags($tags)
    {
        //Creating a new array for tags (newly created)
        $tags = explode(',', $tags);
        $tags_array = [];

        foreach ($tags as $tag) {
            if (is_numeric($tag)) {
                $tags_array[] = $tag;
            }
        }

        return $tags_array;
    }

    /**
     * @param \App\Models\Blogs\Blog $blog
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Blog $blog)
    {
        DB::transaction(function () use ($blog) {
            if ($blog->delete()) {
                BlogMapTag::where('blog_id', $blog->id)->delete();

                event(new BlogDeleted($blog));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.blogs.delete_error'));
        });
    }

    /**
     * Upload Image.
     *
     * @param array $input
     *
     * @return array $input
     */
    public function uploadImage($featured_image)
    {
        $avatar = $featured_image;

        if (isset($featured_image) && !empty($featured_image)) {
            $exploaded_name = explode('.', $avatar->getClientOriginalName());

            $fileName = Str::random().'.'.$exploaded_name[1];
            while (Storage::exists('public/img/blog/'.$fileName)) {
                $fileName = Str::random().'.'.$exploaded_name[1];
            }

            $source=$featured_image;
            //compressing
            $quality=60;//0-9
            $dest="storage/".$this->upload_path.$fileName;
            $this->storage->put($this->upload_path.$fileName, file_get_contents($avatar->getRealPath()));
            $path= $this->compress($source,$dest, $quality);// compressing images
            return $fileName;
        }
    }

    /**
     * Upload Image.
     *
     * @param array $input
     *
     * @return array $input
     */
    public function uploadEditedImage($featured_image)
    {
        $avatar = $featured_image;

        $base64 = str_replace('data:image/png;base64,', '', $featured_image);
        $base64 = str_replace(' ', '+', $base64);
        $image = base64_decode($base64);

        // $user_photo = explode('.', $user->photo);
        $filename = Str::random().'.jpg';
        while (Storage::exists('public/img/blog/'.$filename)) {
            $filename = Str::random().'.jpg';
        }

        Storage::disk('local')->put('public/img/blog/'.$filename, $image);
        
        // compressing image
        // $source= 'storage/img/blog/'.$filename;
        // $quality=100;
        // $dest="storage/img/blog/".$filename;
        // $path= $this->compress($source,$dest, $quality);// compressing images

        return $filename;
    }

    /**
     * Destroy Old Image.
     *
     * @param int $id
     */
    public function deleteOldFile($model)
    {
        $fileName = $model->featured_image;

        return $this->storage->delete($this->upload_path.$fileName);
    }

    public function backupBlogAttachments($attachments, $blog_id)
    {
        $this->deleteBlogAttachment($blog_id);
        $quality = 10;//0-9
        for($i = 0; $i < count($attachments); $i++) {
            if (!Storage::exists('public/img/blog-attachments/'.$attachments[$i])) {
                Storage::copy('public/trix-attachments/'.$attachments[$i], 'public/img/blog-attachments/'.$attachments[$i]);
                
                $source= 'storage/img/blog-attachments/'.$attachments[$i];
                // dd(getimagesize(asset('storage/img/blog-attachments/'.$attachments[$i])));
                $dest="storage/img/blog-attachments/".$attachments[$i];
                $path= $this->compress($source,$dest, $quality);// compressing images
                $this->addBlogImage($attachments[$i], $blog_id);
            }
        }
    }

    public function addBlogImage($filename, $blog_id)
    {
        $blog_image = new BlogImage();
        $blog_image->blog_id = $blog_id;
        $blog_image->imageurl = $filename;
        $blog_image->save();
    }

    public function deleteBlogAttachment($blog_id)
    {
        $blog_attachments = BlogImage::where('blog_id', $blog_id)->get();

        foreach($blog_attachments as $blog_attachment) {
            if (Storage::exists('public/img/blog-attachments/'.$blog_attachment->imageurl)) {
                Storage::delete('public/img/blog-attachments/'.$blog_attachment->imageurl);
            }
        }
        
        BlogImage::where('blog_id', $blog_id)->delete();
    }

    public function deleteTrixAttachments($attachments)
    {
        for($i = 0; $i < count($attachments); $i++) {
            if (Storage::exists('public/trix-attachments/'.$attachments[$i])) {
                Storage::delete('public/trix-attachments/'.$attachments[$i]);
            }
        }
    }

    public function addVideos($blog_id, $videos)
    {
        BlogVideo::where('blog_id', $blog_id)->delete();

        for($i = 0; $i < count($videos); $i++) {
            $blog_video = new BlogVideo();
            $blog_video->blog_id = $blog_id;
            $blog_video->videourl = $videos[$i];
            $blog_video->save();
        }
    }

    public function checkVideoExist($blog_id, $video)
    {
        $blog_video = BlogVideo::where('blog_id', $blog_id)
                ->where('videourl', $video)
                ->first();

        if($blog_video) {
            return true;
        } else {
            return false;
        }
    }

    public function replaceContentFileLocation($content)
    {
        $new_content = str_replace("/storage/trix-attachments", "/storage/img/blog-attachments", $content);

        return $new_content;
    }

    /**
     * This function is used for reducing file size.
     *
     * @param string location of souce image
     * @param string location of destination image
     * @param int quality percentage
     *
     * @return $this
     */
    public function compress($source, $destination, $quality)
    {
        // ini_set('max_execution_time', 0);
        $info = getimagesize($source);
        $filesize = filesize($source);
        $limit_size = 512000;
        if($filesize >= $limit_size) {
            if ($info['mime'] == 'image/jpeg') {
                $image = imagecreatefromjpeg($source);
                imagejpeg($image, $destination, $quality);
            } elseif ($info['mime'] == 'image/gif') {
                $image = imagecreatefromgif($source);
                imagegif($image, $destination, $quality);
            } elseif ($info['mime'] == 'image/png') {
                $image = imagecreatefrompng($source);
                imagepng($image, $destination, 9);
            } else {
                $image = imagecreatefromjpeg($source);
                imagejpeg($image, $destination, $quality);
            }

            $imgWidth=$info[0];
            $img  =   ImageResize::make($destination);

            $img->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destination,10);
        }
        
        //we resize the image to 860px, save it to the large_photos folder
        //with a quality of 85%.Keep the resized images under 85% to pass //the google lighthouse efficiently compress images requirement.
        //there will be no changes in image quality

        // prevent possible upsizing 
         /*   $img->resize(null, 400, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($destination);*/

        return $destination;
    }

    /**
     * @param array $input
     *
     * @throws \App\Exceptions\GeneralException
     *
     * @return bool
     */
    public function createDesignBlog(array $input)
    {
        $tagsArray = $this->createTags($input['tags']);
        unset($input['tags']);

        DB::beginTransaction();
        $input['content'] = $this->replaceContentFileLocation($input['content']);
        $input['slug'] = Str::slug($input['name']);
        $input['publish_datetime'] = ($input['status'] == 'Published' ? Carbon::now() : null);
        $input['created_by'] = $input['user_id'];
        if(isset($input['privacy'])){
            $input['shareable'] = 0;
        }
        else{
            $input['shareable'] = 1;
        }
        if($input['edited_featured_image']) {
            $input['featured_image'] = $this->uploadEditedImage($input['edited_featured_image']);
        } else if(array_key_exists('featured_image', $input)) {
            $input['featured_image'] = $this->duplicateImage($input['featured_image']);
        }
        // $input['featured_image'] = 'ss-1.png';
        
        if ($blog = Blog::create($input)) {
            // Inserting associated tag's id in mapper table
            if (count($tagsArray)) {
                $blog->tags()->sync($tagsArray);
            }

            $groups = explode(',', $input['privacy']);
            $this->setPrivacy($blog->id, 'regular', $groups);

            $blog_panel_design = new BlogDesignPanel();
            $blog_panel_design->blog_id = $blog->id;
            $blog_panel_design->panel_id = $input['panel_id'];
            $blog_panel_design->user_id = $input['user_id'];
            $blog_panel_design->save();

            if($input['attachments'] != '[]') {
                $formatted_attachments = str_replace( array( '\'', '"', ';', '[', ']' ), '', $input['attachments']);
                $formatted_attachments = explode(',', $formatted_attachments);
                $this->backupBlogAttachments($formatted_attachments, $blog->id);

                if($blog->status == 'Published') {
                    $this->deleteTrixAttachments($formatted_attachments);
                }
            }

            event(new BlogCreated($blog));
            DB::commit();
            return $blog;
        }

        throw new GeneralException(trans('exceptions.backend.blogs.create_error'));
    }

    /**
     * Update Blog.
     *
     * @param \App\Models\Blogs\Blog $blog
     * @param array                  $input
     */
    public function updateDesignBlog(Blog $blog, array $input)
    {
        $tagsArray = $this->createTags($input['tags']);
        unset($input['tags']);

        DB::beginTransaction();
        $input['content'] = $this->replaceContentFileLocation($input['content']);
        $input['slug'] = Str::slug($input['name']);

        if($input['status'] != 'Unpublished') {
            $input['publish_datetime'] = ($input['status'] == 'Published' ? Carbon::now() : null);
        }
        
        $input['updated_by'] = access()->user()->id;
        if(isset($input['privacy'])){
            $input['shareable'] = 0;
        }
        else{
            $input['shareable'] = 1;
        }
        // Uploading Image
        if($input['edited_featured_image']) {
            $this->deleteOldFile($blog);
            $input['featured_image'] = $this->uploadEditedImage($input['edited_featured_image']);
        } else if (array_key_exists('featured_image', $input)) {
            $this->deleteOldFile($blog);
            if($input['featured_image'] != '') {
                $input['featured_image'] = $this->duplicateImage($input['featured_image']);
            } else {
                $input['featured_image'] = $input['featured_image'];
            }
        }
        

        if ($blog->update($input)) {

            // Updating associated tag's id in mapper table
            if (count($tagsArray)) {
                $blog->tags()->sync($tagsArray);
            }

            $groups = explode(',', $input['privacy']);
            $this->setPrivacy($blog->id, 'regular', $groups);

            $blog_panel_design = BlogDesignPanel::where('blog_id', $blog->id)->first();
            $blog_panel_design->panel_id = $input['panel_id'];
            $blog_panel_design->user_id = $input['user_id'];
            $blog_panel_design->save();

            if($input['attachments'] != '[]') {
                $formatted_attachments = str_replace( array( '\'', '"', ';', '[', ']' ), '', $input['attachments']);
                $formatted_attachments = explode(',', $formatted_attachments);
                $this->backupBlogAttachments($formatted_attachments, $blog->id);

                if($blog->status == 'Published') {
                    $this->deleteTrixAttachments($formatted_attachments);
                }
            }

            event(new BlogUpdated($blog));
            DB::commit();
            return $blog;
        }

        throw new GeneralException(
            trans('exceptions.backend.blogs.update_error')
        );
    }

    public function duplicateImage($featured_image)
    {
        $extension = explode('.', $featured_image);
        $filename = Str::random().'.'.$extension[1];
        while (Storage::exists('public/img/blog/'.$filename)) {
            $filename = Str::random().'.'.$extension[1];
        }

        if (Storage::exists('public/designPanel/screenshots/'.$featured_image)) {
            Storage::copy('public/designPanel/screenshots/'.$featured_image, 'public/img/blog/'.$filename);

            // compressing image
            $source= 'storage/img/blog/'.$filename;
            $quality=100;
            $dest="storage/img/blog/".$filename;
            $path= $this->compress($source,$dest, $quality);// compressing images
        }

        return $filename;
    }

    public function setPrivacy($blog_id, $blog_type, $groups)
    {
        $privacy = BlogPrivacy::where('blog_id', $blog_id)->delete();
        
        if($groups) {
            for($i = 0; $i < count($groups); $i++) {
                if($groups[$i] > 0) {
                    $new_privacy = new BlogPrivacy();
                    $new_privacy->blog_id = $blog_id;
                    $new_privacy->blog_type = $blog_type;
                    $new_privacy->group_id = $groups[$i];
                    $new_privacy->save();
                }
            }
        }
    }
}
