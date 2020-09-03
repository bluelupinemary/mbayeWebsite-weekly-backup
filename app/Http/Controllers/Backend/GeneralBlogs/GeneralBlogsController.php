<?php

namespace App\Http\Controllers\Backend\GeneralBlogs;

use App\Models\Access\User\User;
use App\Models\Like\GeneralLike;
use App\Http\Controllers\Controller;
use App\Models\Comment\GeneralComment;
use App\Http\Responses\RedirectResponse;
use App\Models\GeneralBlogs\GeneralBlog;
use App\Repositories\Backend\GeneralBlogs\GeneralBlogsRepository;
use App\Http\Requests\Backend\GeneralBlogs\ShowGeneralBlogsRequest;
use App\Http\Responses\Backend\GeneralBlog\EditGeneralBlogResponse;
use App\Http\Responses\Backend\GeneralBlog\ShowGeneralBlogResponse;
use App\Http\Requests\Backend\GeneralBlogs\StoreGeneralBlogsRequest;
use App\Http\Responses\Backend\GeneralBlog\IndexGeneralBlogResponse;
use App\Http\Requests\Backend\GeneralBlogs\ManageGeneralBlogsRequest;
use App\Http\Requests\Backend\GeneralBlogs\UpdateGeneralBlogsRequest;
use App\Http\Responses\Backend\GeneralBlog\CreateGeneralBlogResponse;

/**
 * Class BlogsController.
 */
class GeneralBlogsController extends Controller
{
    /**
     * Blog Status.
     */
    protected $status = [
        'Published' => 'Published',
        'Draft'     => 'Draft',
        'InActive'  => 'InActive',
        'Scheduled' => 'Scheduled',
    ];

    /**
     * @var GeneralBlogsRepository
     */
    protected $blog;

    /**
     * @param \App\Repositories\Backend\Blogs\GeneralBlogsRepository $blog
     */
    public function __construct(GeneralBlogsRepository $blog)
    {
        $this->blog = $blog;
    }

    /**
     * @param \App\Http\Requests\Backend\Blogs\ManageGeneralBlogsRequest $request
     *
     * @return \App\Http\Responses\Backend\Blog\IndexResponse
     */
    public function index(ManageGeneralBlogsRequest $request)
    {
        return new IndexGeneralBlogResponse($this->status);
    }

    /**
     * @param \App\Http\Requests\Backend\Blogs\ManageGeneralBlogsRequest $request
     *
     * @return mixed
     */
    public function create(ManageGeneralBlogsRequest $request)
    {

        return new CreateGeneralBlogResponse($this->status);
    }

    /**
     * @param \App\Http\Requests\Backend\Blogs\StoreGeneralBlogsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreGeneralBlogsRequest $request)
    {
        $this->blog->create($request->except('_token'));

        return new RedirectResponse(route('admin.generalblogs.index'), ['flash_success' => trans('alerts.backend.blogs.created')]);
    }

    public function show($b, ManageGeneralBlogsRequest $request)
    {
        // dd($b);
        $blog = GeneralBlog::find($b);
        $comments = GeneralComment::where('blog_id',$blog->id)->get();
        $emotions = [
            'hotcount'          => GeneralLike::where('blog_id',$blog->id)->where('emotion',0)->count(),
            'coolcount'          => GeneralLike::where('blog_id',$blog->id)->where('emotion',1)->count(),
            'naffcount'          => GeneralLike::where('blog_id',$blog->id)->where('emotion',2)->count(),
        ];
        // dd($blog);
        return new ShowGeneralBlogResponse($blog, $this->status,$comments,$emotions);
    }

    /**
     * @param \App\Models\GeneralBlogs\GeneralBlog                              $blog
     * @param \App\Http\Requests\Backend\Blogs\ManageBlogsRequest $request
     *
     * @return \App\Http\Responses\Backend\Blog\EditResponse
     */
    public function edit($b, ManageGeneralBlogsRequest $request)
    {
        // $blogTags = BlogTag::getSelectData();
        $blog = GeneralBlog::findOrFail($b);
        // dd($blog);
        return new EditGeneralBlogResponse($blog,$this->status);
    }

    /**
     * @param \App\Models\Blogs\Blog                              $blog
     * @param \App\Http\Requests\Backend\Blogs\UpdateBlogsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */

    public function update($b, UpdateGeneralBlogsRequest $request)
    {
        $blog = GeneralBlog::findOrFail($b);
        $input = $request->all();

        $this->blog->update($blog, $request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.generalblogs.index'), ['flash_success' => trans('alerts.backend.blogs.updated')]);
    }

    /**
     * @param \App\Models\Blogs\GeneralBlog                              $blog
     * @param \App\Http\Requests\Backend\Blogs\ManageGeneralBlogsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy($b, ManageGeneralBlogsRequest $request)
    {
        $blog = GeneralBlog::findOrFail($b);
        $this->blog->delete($blog);

        return new RedirectResponse(route('admin.generalblogs.index'), ['flash_success' => trans('alerts.backend.blogs.deleted')]);
    }

    public function deletecomment($id){
        $cmnt = GeneralComment::where('id',$id)->first();
        $blog = GeneralBlog::where('id',$cmnt->blog_id)->first();
        $comment = $cmnt->delete();
        // dd($blog);
        if($comment){
            return new RedirectResponse(route('admin.blogs.show',$blog->id), ['flash_success' => "Comment Deleted"]);
        }
        return new RedirectResponse(route('admin.blogs.show',$blog->id), ['flash_warning' => "Comment Not Find"]);
    }

   
}
