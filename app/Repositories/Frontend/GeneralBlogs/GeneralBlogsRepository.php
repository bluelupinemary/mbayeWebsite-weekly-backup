<?php

namespace App\Repositories\Frontend\GeneralBlogs;

use Image;
use ImageResize;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use App\Models\BlogPrivacy\BlogPrivacy;
use Illuminate\Support\Facades\Storage;
use App\Models\GeneralBlogs\GeneralBlog;
use App\Events\Backend\Blogs\BlogCreated;
use App\Events\Backend\Blogs\BlogDeleted;
use App\Events\Backend\Blogs\BlogUpdated;
use App\Models\GeneralBlogImages\GeneralBlogImage;
use App\Models\GeneralBlogVideos\GeneralBlogVideo;

/**
 * Class BlogsRepository.
 */
class GeneralBlogsRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = GeneralBlog::class;

    protected $upload_path;

    /**
     * Storage Class Object.
     *
     * @var \Illuminate\Support\Facades\Storage
     */
    protected $storage;

    public function __construct()
    {
        $this->upload_path = 'img'.DIRECTORY_SEPARATOR.'general_blogs'.DIRECTORY_SEPARATOR;
        $this->storage = Storage::disk('public');
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
    
        return $this->query()
            ->leftjoin(config('access.users_table'), config('access.users_table').'.id', '=', config('module.general_blogs.table').'.created_by')
            // ->leftJoin('general_blog_shares AS b', 'b.general_blog_id', '=','general_blogs.id' )
            ->select([
                config('module.general_blogs.table').'.id',
                config('module.general_blogs.table').'.name',
                config('module.general_blogs.table').'.featured_image',
                config('module.general_blogs.table').'.publish_datetime',
                config('module.general_blogs.table').'.status',
                config('module.general_blogs.table').'.created_by',
                config('module.general_blogs.table').'.created_at',
               config('access.users_table').'.first_name as user_name',
            ]);
    }

    public function createGeneralBlog(array $input)
    {
        DB::beginTransaction();
        $input['content'] = $this->replaceContentFileLocation($input['content']);
        $input['slug'] = Str::slug($input['name']);
        $input['publish_datetime'] = ($input['status'] == 'Published' ? Carbon::now() : null);
        $input['created_by'] = access()->user()->id;
        if(isset($input['shareable'])){
            $input['shareable'] = 0;
        }
        if($input['edited_featured_image']) {
            $input['featured_image'] = $this->uploadEditedImage($input['edited_featured_image']);
        } else if(array_key_exists('featured_image', $input)) {
            $input['featured_image'] = $this->uploadImage($input['featured_image']);
        }
        
        if ($blog = GeneralBlog::create($input)) {
            // Inserting videos
            if(array_key_exists('videos', $input)) {
                $this->addGeneralBlogVideos($blog->id, $input['videos']);
            }

            // Save privacy settings
            $groups = explode(',', $input['privacy']);
            $this->setPrivacy($blog->id, 'general', $groups);

            if($input['attachments'] != '[]') {
                $formatted_attachments = str_replace( array( '\'', '"', ';', '[', ']' ), '', $input['attachments']);
                $formatted_attachments = explode(',', $formatted_attachments);
                $this->backupGeneralBlogAttachments($formatted_attachments, $blog->id);

                if($blog->status == 'Published') {
                    $this->deleteTrixAttachments($formatted_attachments);
                }
            }

            // event(new BlogCreated($blog));
            DB::commit();
            return $blog;
        }

        throw new GeneralException(trans('exceptions.backend.blogs.create_error'));
    }

    public function replaceContentFileLocation($content)
    {
        $new_content = str_replace("/storage/trix-attachments", "/storage/img/blog-attachments", $content);

        return $new_content;
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

    public function updateGeneralBlog(GeneralBlog $blog, array $input)
    {
        DB::beginTransaction();
        $input['content'] = $this->replaceContentFileLocation($input['content']);
        $input['slug'] = Str::slug($input['name']);

        if($input['status'] != 'Unpublished') {
            $input['publish_datetime'] = ($input['status'] == 'Published' ? Carbon::now() : null);
        }
        
        $input['updated_by'] = access()->user()->id;

        // Uploading Image
        if($input['edited_featured_image']) {
            $this->deleteOldFile($blog);
            $input['featured_image'] = $this->uploadEditedImage($input['edited_featured_image']);
        } else if (array_key_exists('featured_image', $input)) {
            $this->deleteOldFile($blog);
            $input['featured_image'] = $this->uploadImage($input['featured_image']);
        }
        

        if ($blog->update($input)) {
            // Inserting videos
            if(array_key_exists('videos', $input)) {
                $this->addGeneralBlogVideos($blog->id, $input['videos']);
            }

            // Save privacy settings
            $groups = explode(',', $input['privacy']);
            $this->setPrivacy($blog->id, 'general', $groups);

            if($input['attachments'] != '[]') {
                $formatted_attachments = str_replace( array( '\'', '"', ';', '[', ']' ), '', $input['attachments']);
                $formatted_attachments = explode(',', $formatted_attachments);
                $this->backupGeneralBlogAttachments($formatted_attachments, $blog->id);

                if($blog->status == 'Published') {
                    $this->deleteTrixAttachments($formatted_attachments);
                }
            }

            // event(new BlogUpdated($blog));
            DB::commit();
            return $blog;
        }

        throw new GeneralException(
            trans('exceptions.backend.blogs.update_error')
        );
    }

    public function addGeneralBlogImage($filename, $blog_id)
    {
        $blog_image = new GeneralBlogImage();
        $blog_image->blog_id = $blog_id;
        $blog_image->imageurl = $filename;
        $blog_image->save();
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
            $fileName = time().$avatar->getClientOriginalName();
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
        while (Storage::exists('public/img/general_blogs/'.$filename)) {
            $filename = Str::random().'.jpg';
        }

        Storage::disk('local')->put('public/img/general_blogs/'.$filename, $image);
        
        // compressing image
        // $source= 'storage/img/blog/'.$filename;
        // $quality=100;
        // $dest="storage/img/blog/".$filename;
        // $path= $this->compress($source,$dest, $quality);// compressing images

        return $filename;
    }

    public function deleteGeneralBlogAttachment($blog_id)
    {
        $blog_attachments = GeneralBlogImage::where('blog_id', $blog_id)->get();

        foreach($blog_attachments as $blog_attachment) {
            if (Storage::exists('public/img/blog-attachments/'.$blog_attachment->imageurl)) {
                Storage::delete('public/img/blog-attachments/'.$blog_attachment->imageurl);
            }
        }
        
        GeneralBlogImage::where('blog_id', $blog_id)->delete();
    }

    public function addGeneralBlogVideos($blog_id, $videos)
    {
        GeneralBlogVideo::where('blog_id', $blog_id)->delete();

        for($i = 0; $i < count($videos); $i++) {
            $blog_video = new GeneralBlogVideo();
            $blog_video->blog_id = $blog_id;
            $blog_video->videourl = $videos[$i];
            $blog_video->save();
        }
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

    public function backupGeneralBlogAttachments($attachments, $blog_id)
    {
        $this->deleteGeneralBlogAttachment($blog_id);
        $quality = 10;//0-9
        for($i = 0; $i < count($attachments); $i++) {
            if (!Storage::exists('public/img/blog-attachments/'.$attachments[$i])) {
                Storage::copy('public/trix-attachments/'.$attachments[$i], 'public/img/blog-attachments/'.$attachments[$i]);
                
                $source= 'storage/img/blog-attachments/'.$attachments[$i];
                // dd(getimagesize(asset('storage/img/blog-attachments/'.$attachments[$i])));
                $dest="storage/img/blog-attachments/".$attachments[$i];
                $path= $this->compress($source,$dest, $quality);// compressing images
                $this->addGeneralBlogImage($attachments[$i], $blog_id);
            }
        }
    }

    public function deleteTrixAttachments($attachments)
    {
        for($i = 0; $i < count($attachments); $i++) {
            if (Storage::exists('public/trix-attachments/'.$attachments[$i])) {
                Storage::delete('public/trix-attachments/'.$attachments[$i]);
            }
        }
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
            $img  = ImageResize::make($destination);

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
}
