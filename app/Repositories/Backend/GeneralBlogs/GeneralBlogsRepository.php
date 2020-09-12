<?php

namespace App\Repositories\Backend\GeneralBlogs;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
// use App\Models\BlogMapTags\BlogMapTag;
use App\Repositories\BaseRepository;
// use App\Models\BlogTags\BlogTag;
use Illuminate\Support\Facades\Storage;
use App\Models\GeneralBlogs\GeneralBlog;
use App\Events\Backend\GeneralBlogs\GeneralBlogCreated;
use App\Events\Backend\GeneralBlogs\GeneralBlogDeleted;
use App\Events\Backend\GeneralBlogs\GeneralBlogUpdated;

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
                config('access.users_table').'.first_name as first_name',
                config('access.users_table').'.last_name as last_name',
                config('access.users_table').'.email as email',
            ]);
    }

    public function getdeletedblog()
    {

        return $this->query()
        ->leftjoin(config('access.users_table'), config('access.users_table').'.id', '=', config('module.general_blogs.table').'.created_by')->onlyTrashed()
            ->select([
                config('module.general_blogs.table').'.id',
                config('module.general_blogs.table').'.name',
                config('module.general_blogs.table').'.featured_image',
                config('module.general_blogs.table').'.publish_datetime',
                config('module.general_blogs.table').'.status',
                config('module.general_blogs.table').'.created_by',
                config('module.general_blogs.table').'.created_at',
                config('access.users_table').'.first_name as first_name',
                config('access.users_table').'.last_name as last_name',
                config('access.users_table').'.email as email',
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
        DB::transaction(function () use ($input) {
            $input['slug'] = Str::slug($input['name']);
            $input['publish_datetime'] = Carbon::parse($input['publish_datetime']);
            $input = $this->uploadImage($input);
            $input['created_by'] = access()->user()->id;

            if ($blog = GeneralBlog::create($input)) {
                event(new GeneralBlogCreated($blog));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.blogs.create_error'));
        });
    }

    /**
     * Update Blog.
     *
     * @param \App\Models\Blogs\Blog $blog
     * @param array                  $input
     */
    public function update(GeneralBlog $blog, array $input)
    {
        $input['slug'] = Str::slug($input['name']);
        $input['publish_datetime'] = Carbon::parse($input['publish_datetime']);
        $input['updated_by'] = access()->user()->id;

        // Uploading Image
        if (array_key_exists('featured_image', $input)) {
            $this->deleteOldFile($blog);
            $input = $this->uploadImage($input);
        }

        DB::transaction(function () use ($blog, $input) {
            if ($blog->update($input)) {

                // Updating associated tag's id in mapper table
                event(new GeneralBlogUpdated($blog));

                return true;
            }

            throw new GeneralException(
                trans('exceptions.backend.blogs.update_error')
            );
        });
    }

    /**
     * @param \App\Models\Blogs\Blog $blog
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(GeneralBlog $blog)
    {
        DB::transaction(function () use ($blog) {
            if ($blog->delete()) {

                event(new GeneralBlogDeleted($blog));

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
    public function uploadImage($input)
    {
        $avatar = $input['featured_image'];

        if (isset($input['featured_image']) && !empty($input['featured_image'])) {
            $fileName = time().$avatar->getClientOriginalName();

            $this->storage->put($this->upload_path.$fileName, file_get_contents($avatar->getRealPath()));

            $input = array_merge($input, ['featured_image' => $fileName]);

            return $input;
        }
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

    public function restore($blog)
    {
        if (is_null($blog->deleted_at)) {
            // throw new GeneralException(trans('exceptions.backend.access.users.cant_restore'));
        }

        if ($blog->restore()) {
            // event(new UserRestored($user));

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.restore_error'));
    }

    /**
     * @param $user
     *
     * @throws GeneralException
     */
    public function forceDelete($blog)
    {
        if (is_null($blog->deleted_at)) {
            throw new GeneralException(trans('exceptions.backend.access.users.delete_first'));
        }

        DB::transaction(function () use ($blog) {
            if ($blog->forceDelete()) {
                // event(new UserPermanentlyDeleted($user));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.access.users.delete_error'));
        });
    }
}
