<?php

namespace App\Repositories\Frontend\CareStories;

use Image;
use ImageResize;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Events\NewCareStoryEvent;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use App\Models\CareStories\CareStory;
use Illuminate\Support\Facades\Storage;
use App\Models\CareStoryImages\CareStoryImage;
use App\Models\CareStoryVideos\CareStoryVideo;

/**
 * Class BlogsRepository.
 */
class CareStoriesRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = CareStory::class;

    protected $upload_path;

    /**
     * Storage Class Object.
     *
     * @var \Illuminate\Support\Facades\Storage
     */
    protected $storage;

    public function __construct()
    {
        $this->upload_path = 'img'.DIRECTORY_SEPARATOR.'story_of_care'.DIRECTORY_SEPARATOR;
        $this->storage = Storage::disk('public');
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
        DB::beginTransaction();
        // $input['content'] = $this->replaceContentFileLocation($input['content']);
        $input['slug'] = Str::slug($input['name']);
        $input['publish_datetime'] = Carbon::now();
        $input['created_by'] = $input['user_id'];
        $input['go_fund_me_link'] = $input['go_find_me_link'];
        

        if($input['edited_featured_image']) {
            $input['featured_image'] = $this->uploadEditedImage($input['edited_featured_image']);
        } else if(array_key_exists('featured_image', $input)) {
            $input['featured_image'] = $this->duplicateImage($input['featured_image']);
        }
        
        if ($care_story = CareStory::create($input)) {
            // Inserting videos
            if(array_key_exists('videos', $input)) {
                $this->addVideos($care_story->id, $input['videos']);
            }

            if(array_key_exists('image', $input)) {
                for($i = 0; $i < count($input['image']); $i++) {
                    $image = $this->uploadAttachedImage($input['image'][$i]);

                    $this->addBlogImage($image, $care_story->id);
                }
                // $formatted_attachments = str_replace( array( '\'', '"', ';', '[', ']' ), '', $input['attachments']);
                // $formatted_attachments = explode(',', $formatted_attachments);
                // $this->backupBlogAttachments($formatted_attachments, $care_story->id);

                // if($care_story->status == 'Published') {
                //     $this->deleteTrixAttachments($formatted_attachments);
                // }
            }

            // event(new BlogCreated($blog));
            DB::commit();
            broadcast(new NewCareStoryEvent($care_story))->toOthers();
            return $care_story;
        }

        throw new GeneralException(trans('exceptions.backend.care_stories.create_error'));
    }

    /**
     * Update Blog.
     *
     * @param \App\Models\Blogs\Blog $blog
     * @param array                  $input
     */
    public function update(CareStory $care_story, array $input)
    {
        DB::beginTransaction();
        // $input['content'] = $this->replaceContentFileLocation($input['content']);
        $input['slug'] = Str::slug($input['name']);

        if($input['status'] != 'Unpublished') {
            $input['publish_datetime'] = Carbon::now();
        }
        $input['go_fund_me_link'] = $input['go_find_me_link'];
        $input['updated_by'] = access()->user()->id;

        // Uploading Image
        if($input['edited_featured_image']) {
            $this->deleteOldFile($care_story);
            $input['featured_image'] = $this->uploadEditedImage($input['edited_featured_image']);
        } else if (array_key_exists('featured_image', $input)) {
            if($input['featured_image'] != '') {
                $this->deleteOldFile($care_story);
                $input['featured_image'] = $this->duplicateImage($input['featured_image']);
            } else {
                $input['featured_image'] = $care_story->featured_image;
            }
        }
        

        if ($care_story->update($input)) {
            // Inserting videos
            if(array_key_exists('videos', $input)) {
                $this->addVideos($care_story->id, $input['videos']);
            } else {
                $this->removeVideos($care_story->id);
            }

            
            if(array_key_exists('image', $input)) {
                for($i = 0; $i < count($input['image']); $i++) {
                    $image = $this->uploadAttachedImage($input['image'][$i]);

                    $this->addBlogImage($image, $care_story->id);
                }
                // $formatted_attachments = str_replace( array( '\'', '"', ';', '[', ']' ), '', $input['attachments']);
                // $formatted_attachments = explode(',', $formatted_attachments);
                // $this->backupBlogAttachments($formatted_attachments, $care_story->id);

                // if($care_story->status == 'Published') {
                //     $this->deleteTrixAttachments($formatted_attachments);
                // }
            }

            // event(new BlogUpdated($blog));
            DB::commit();
            return $care_story;
        }

        throw new GeneralException(
            trans('exceptions.backend.care_stories.update_error')
        );
    }

    /**
     * @param \App\Models\Blogs\Blog $blog
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(CareStory $care_story)
    {
        DB::transaction(function () use ($care_story) {
            if ($care_story->delete()) {

                // event(new BlogDeleted($blog));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.care_stories.delete_error'));
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
            while (Storage::exists('public/img/story_of_care/'.$fileName)) {
                $fileName = Str::random().'.'.$exploaded_name[1];
            }

            $source=$featured_image;
            //compressing
            $quality=80;//0-9
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
        while (Storage::exists('public/img/story_of_care/'.$filename)) {
            $filename = Str::random().'.jpg';
        }

        Storage::disk('local')->put('public/img/story_of_care/'.$filename, $image);
        
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

    public function backupBlogAttachments($attachments, $care_story_id)
    {
        $this->deleteBlogAttachment($care_story_id);
        $quality = 80;//0-9
        for($i = 0; $i < count($attachments); $i++) {
            if (!Storage::exists('public/img/blog-attachments/'.$attachments[$i])) {
                Storage::copy('public/trix-attachments/'.$attachments[$i], 'public/img/blog-attachments/'.$attachments[$i]);
                
                $source= 'storage/img/blog-attachments/'.$attachments[$i];
                // dd(getimagesize(asset('storage/img/blog-attachments/'.$attachments[$i])));
                $dest="storage/img/blog-attachments/".$attachments[$i];
                $path= $this->compress($source,$dest, $quality);// compressing images
                $this->addBlogImage($attachments[$i], $care_story_id);
            }
        }
    }

    public function addBlogImage($filename, $care_story_id)
    {
        $image = new CareStoryImage();
        $image->care_story_id = $care_story_id;
        $image->imageurl = $filename;
        $image->save();
    }

    public function deleteBlogAttachment($care_story_id)
    {
        $blog_attachments = CareStoryImage::where('care_story_id', $care_story_id)->get();

        foreach($blog_attachments as $blog_attachment) {
            if (Storage::exists('public/img/blog-attachments/'.$blog_attachment->imageurl)) {
                Storage::delete('public/img/blog-attachments/'.$blog_attachment->imageurl);
            }
        }
        
        CareStoryImage::where('care_story_id', $care_story_id)->delete();
    }

    public function deleteTrixAttachments($attachments)
    {
        for($i = 0; $i < count($attachments); $i++) {
            if (Storage::exists('public/trix-attachments/'.$attachments[$i])) {
                Storage::delete('public/trix-attachments/'.$attachments[$i]);
            }
        }
    }

    public function removeVideos($care_story_id)
    {
        CareStoryVideo::where('care_story_id', $care_story_id)->delete();
    }

    public function addVideos($care_story_id, $videos)
    {
        CareStoryVideo::where('care_story_id', $care_story_id)->delete();

        for($i = 0; $i < count($videos); $i++) {
            $video = new CareStoryVideo();
            $video->care_story_id = $care_story_id;
            $video->videourl = $videos[$i];
            $video->save();
        }
    }

    public function checkVideoExist($care_story_id, $video)
    {
        $video = CareStoryVideo::where('care_story_id', $care_story_id)
                ->where('videourl', $video)
                ->first();

        if($video) {
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
                imagepng($image, $destination, $quality);
            } else {
                $image = imagecreatefromjpeg($source);
                imagejpeg($image, $destination, $quality);
            }

            $imgWidth=$info[0];
            $img  =   ImageResize::make($destination);

            // $img->resize(500, null, function ($constraint) {
            //     $constraint->aspectRatio();
            // })->save($destination,10);
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

    public function duplicateImage($featured_image)
    {
        $extension = explode('.', $featured_image);
        $filename = Str::random().'.'.$extension[1];
        while (Storage::exists('public/img/story_of_care/'.$filename)) {
            $filename = Str::random().'.'.$extension[1];
        }

        if (Storage::exists('public/saveState/designPanel/screenshots/'.$featured_image)) {
            Storage::copy('public/saveState/designPanel/screenshots/'.$featured_image, 'public/img/story_of_care/'.$filename);

            // compressing image
            $source= 'storage/img/story_of_care/'.$filename;
            $quality=100;
            $dest="storage/img/story_of_care/".$filename;
            $path= $this->compress($source,$dest, $quality);// compressing images
        }

        return $filename;
    }

    /**
     * Upload Image Attachment.
     *
     * @param array $input
     *
     * @return array $input
     */
    public function uploadAttachedImage($featured_image)
    {
        $avatar = $featured_image;

        if (isset($featured_image) && !empty($featured_image)) {
            $exploaded_name = explode('.', $avatar->getClientOriginalName());

            $fileName = Str::random().'.'.$exploaded_name[1];
            while (Storage::exists('public/img/storyofcare_attachments/'.$fileName)) {
                $fileName = Str::random().'.'.$exploaded_name[1];
            }

            $source=$featured_image;
            //compressing
            $quality=60;//0-9
            $dest="storage/img/storyofcare_attachments/".$fileName;
            $this->storage->put('img/storyofcare_attachments/'.$fileName, file_get_contents($avatar->getRealPath()));
            $path= $this->compress($source,$dest, $quality);// compressing images
            return $fileName;
        }
    }
}
