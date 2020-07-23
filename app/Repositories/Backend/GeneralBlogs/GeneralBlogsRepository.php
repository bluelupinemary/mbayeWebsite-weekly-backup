<?php

namespace App\Repositories\Backend\GeneralBlogs;

use App\Events\Backend\Blogs\BlogCreated;
use App\Events\Backend\Blogs\BlogDeleted;
use App\Events\Backend\Blogs\BlogUpdated;
use App\Exceptions\GeneralException;
use App\Models\BlogMapTags\BlogMapTag;
use App\Models\GeneralBlogs\GeneralBlog;
use App\Models\BlogTags\BlogTag;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
