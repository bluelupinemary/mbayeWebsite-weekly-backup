<?php

namespace App\Repositories\Backend\BlogPanelDesign;

use App\Events\Backend\Blogs\BlogCreated;
use App\Events\Backend\Blogs\BlogDeleted;
use App\Events\Backend\Blogs\BlogUpdated;
use App\Exceptions\GeneralException;
use App\Models\BlogMapTags\BlogMapTag;
use App\Models\BlogDesignPanels\BlogDesignPanel;
use App\Models\BlogTags\BlogTag;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

        return $this->query()
        ->leftjoin(config('access.users_table'), config('access.users_table').'.id', '=', config('module.blog_panel_design.table').'.user_id')
            ->leftJoin('blogs AS b', 'b.id', '=','blog_panel_design.blog_id' )
            ->select([
               'b.id',
                'b.name',
                'b.featured_image',
                'b.publish_datetime',
                'b.status',
                'b.created_at',
               config('access.users_table').'.first_name as user_name',
               
            ]);  
          
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
        $tags_array = [];

        foreach ($tags as $tag) {
            if (is_numeric($tag)) {
                $tags_array[] = $tag;
            } else {
                $newTag = BlogTag::create(['name' => $tag, 'status' => 1, 'created_by' => 1]);
                $tags_array[] = $newTag->id;
            }
        }

        return $tags_array;
    }

    

    
}
