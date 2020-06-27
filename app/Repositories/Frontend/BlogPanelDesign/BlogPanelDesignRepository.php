<?php

namespace App\Repositories\Frontend\BlogPanelDesign;

use App\Events\Backend\Blogs\BlogCreated;
use App\Events\Backend\Blogs\BlogDeleted;
use App\Events\Backend\Blogs\BlogUpdated;
use App\Exceptions\GeneralException;
use App\Models\BlogMapTags\BlogMapTag;
use App\Models\BlogDesignPanels\BlogDesignPanel;
use App\Models\BlogTags\BlogTag;
use App\Models\BlogVideos\BlogVideo;
use App\Models\BlogImages\BlogImage;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;
use ImageResize;

/**
 * Class BlogsRepository.
 */
class BlogPanelDesignRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = BlogDesignPanel::class;

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
      //dd("fgfg");
        return $this->query()
            ->leftjoin(config('access.users_table'), config('access.users_table').'.id', '=', config('module.blog_panel_design.table').'.user_id')
            ->leftJoin('blog_panel_design AS bd', 'bd.blog_id', '=','blogs.id' )
            ->select([
                config('module.blogs.table').'.id',
                config('module.blogs.table').'.name',
                config('module.blogs.table').'.publish_datetime',
                config('module.blogs.table').'.status',
                config('module.blogs.table').'.created_at',
                config('access.users_table').'.first_name as user_name',
            ]);
    }

    


    public function addBlogImage($filename, $blog_id)
    {
        $blog_image = new BlogImage();
        $blog_image->blog_id = $blog_id;
        $blog_image->imageurl = $filename;
        $blog_image->save();
    }

   

    public function replaceContentFileLocation($content)
    {
        $new_content = str_replace("/storage/trix-attachments", "/storage/img/blog-attachments", $content);

        return $new_content;
    }

}
