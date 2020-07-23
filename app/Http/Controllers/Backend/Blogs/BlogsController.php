<?php

namespace App\Http\Controllers\Backend\Blogs;

use App\Models\Like\Like;
use App\Models\Blogs\Blog;
use App\Models\Comment\Comment;
use App\Models\Access\User\User;
use App\Models\BlogTags\BlogTag;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\Backend\Blog\EditResponse;
use App\Http\Responses\Backend\Blog\ShowResponse;
use App\Http\Responses\Backend\Blog\IndexResponse;
use App\Http\Responses\Backend\Blog\CreateResponse;
use App\Repositories\Backend\Blogs\BlogsRepository;
use App\Http\Requests\Backend\Blogs\ShowBlogsRequest;
use App\Http\Requests\Backend\Blogs\StoreBlogsRequest;
use App\Http\Requests\Backend\Blogs\ManageBlogsRequest;
use App\Http\Requests\Backend\Blogs\UpdateBlogsRequest;

/**
 * Class BlogsController.
 */
class BlogsController extends Controller
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
     * @var BlogsRepository
     */
    protected $blog;

    /**
     * @param \App\Repositories\Backend\Blogs\BlogsRepository $blog
     */
    public function __construct(BlogsRepository $blog)
    {
        $this->blog = $blog;
    }

    /**
     * @param \App\Http\Requests\Backend\Blogs\ManageBlogsRequest $request
     *
     * @return \App\Http\Responses\Backend\Blog\IndexResponse
     */
    public function index(ManageBlogsRequest $request)
    {
        return new IndexResponse($this->status);
    }

    /**
     * @param \App\Http\Requests\Backend\Blogs\ManageBlogsRequest $request
     *
     * @return mixed
     */
    public function create(ManageBlogsRequest $request)
    {
        $blogTags = BlogTag::getSelectData();

        return new CreateResponse($this->status,$blogTags);
    }

    /**
     * @param \App\Http\Requests\Backend\Blogs\StoreBlogsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreBlogsRequest $request)
    {
        $this->blog->create($request->except('_token'));

        return new RedirectResponse(route('admin.blogs.index'), ['flash_success' => trans('alerts.backend.blogs.created')]);
    }

    public function show(Blog $blog, ManageBlogsRequest $request)
    {
        $blogTags = BlogTag::getSelectData();
        $comments = Comment::where('blog_id',$blog->id)->get();
        $emotions = [
            'hotcount'          => Like::where('blog_id',$blog->id)->where('emotion',0)->count(),
            'coolcount'          => Like::where('blog_id',$blog->id)->where('emotion',1)->count(),
            'naffcount'          => Like::where('blog_id',$blog->id)->where('emotion',2)->count(),
        ];
        return new ShowResponse($blog, $this->status, $blogTags,$comments,$emotions);
    }

    /**
     * @param \App\Models\Blogs\Blog                              $blog
     * @param \App\Http\Requests\Backend\Blogs\ManageBlogsRequest $request
     *
     * @return \App\Http\Responses\Backend\Blog\EditResponse
     */
    public function edit(Blog $blog, ManageBlogsRequest $request)
    {
        $blogTags = BlogTag::getSelectData();

        return new EditResponse($blog, $this->status, $blogTags);
    }

    /**
     * @param \App\Models\Blogs\Blog                              $blog
     * @param \App\Http\Requests\Backend\Blogs\UpdateBlogsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */

    public function update(Blog $blog, UpdateBlogsRequest $request)
    {
        $input = $request->all();

        $this->blog->update($blog, $request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.blogs.index'), ['flash_success' => trans('alerts.backend.blogs.updated')]);
    }

    /**
     * @param \App\Models\Blogs\Blog                              $blog
     * @param \App\Http\Requests\Backend\Blogs\ManageBlogsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Blog $blog, ManageBlogsRequest $request)
    {
        $this->blog->delete($blog);

        return new RedirectResponse(route('admin.blogs.index'), ['flash_success' => trans('alerts.backend.blogs.deleted')]);
    }

    public function deletecomment($id){
        $cmnt = Comment::where('id',$id)->first();
        $blog = Blog::where('id',$cmnt->blog_id)->first();
        $comment = $cmnt->delete();
        // dd($blog);
        if($comment){
            return new RedirectResponse(route('admin.blogs.show',$blog->id), ['flash_success' => "Comment Deleted"]);
        }
        return new RedirectResponse(route('admin.blogs.show',$blog->id), ['flash_warning' => "Comment Not Find"]);
    }

   
}
