<?php

namespace App\Http\Controllers\Backend\GeneralBlogs;

use App\Models\GeneralBlogs\GeneralBlog;
use App\Http\Requests\Request;
use Illuminate\Support\Carbon;
use App\Models\Access\User\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\GeneralBlogs\GeneralBlogsRepository;
use App\Http\Requests\Backend\Blogs\ManageBlogsRequest;
use App\Http\Requests\Backend\Access\User\DeleteUserRequest;
use App\Http\Requests\Backend\Access\User\ManageDeletedRequest;
use App\Http\Requests\Backend\Access\User\ManageFeaturedRequest;
use App\Http\Requests\Backend\Access\User\ManageDeactivatedRequest;

/**
 * Class UserStatusController.
 */
class GeneralBlogStatusController extends Controller
{
    /**
     * @var BlogsRepository
     */
    protected $blogs;

    /**
     * @param BlogsRepository $users
     */
    public function __construct(GeneralBlogsRepository $blogs)
    {
        $this->blogs = $blogs;
    }

    /**
     * @param ManageDeletedRequest $request
     *
     * @return mixed
     */
    public function getDeleted(ManageDeletedRequest $request)
    {
        return view('backend.generalblogs.deleted');
    }

    /**
     * @param User              $deletedUser
     * @param DeleteUserRequest $request
     *
     * @return mixed
     */
    public function delete($blog)
    {
        // dd($blog);
        $blog = GeneralBlog::onlyTrashed()->where('id',$blog)->first();
        $this->blogs->forceDelete($blog);
        return redirect()->route('admin.generalblogs.deleted')->withFlashSuccess(trans('alerts.backend.users.deleted_permanently'));
    }

    /**
     * @param User              $deletedUser
     * @param DeleteUserRequest $request
     *
     * @return mixed
     */
    public function restore($blog)
    {
        $blog = GeneralBlog::onlyTrashed()->where('id',$blog)->first();
        $this->blogs->restore($blog);

        return redirect()->route('admin.generalblogs.index')->withFlashSuccess(trans('alerts.backend.users.restored'));
    }

}
