<?php

namespace App\Http\Controllers\Frontend\Blogs;

use Carbon\Carbon;
use App\Models\Blogs\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Access\User\User;
use App\Models\BlogTags\BlogTag;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\Backend\Blog\EditResponse;
use App\Http\Responses\Backend\Blog\IndexResponse;
use App\Http\Responses\Backend\Blog\CreateResponse;
use App\Repositories\Frontend\Blogs\BlogsRepository;
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
        'Unpublished' => 'Unpublished',
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
    public function index(Request $request)
    {
        $search = $request->search;
        $sort = $request->sort;
        $status = $request->status;

        $blogs = Blog::where('created_by', Auth::user()->id)
                ->when($status, function ($query, $status) {
                    return  $query->where('status', $status);
                })
                ->when($search, function ($query, $search) {
                    return $query->where(function ($q) use ($search) {
                        $q->where('name', 'like', '%'.$search.'%')
                        ->orWhere('content', 'like', '%'.$search.'%');
                    });
                })
                ->when($sort, function ($query, $sort) {
                    if($sort == 'asc_name') {
                        $query = $query->orderBy('name', 'asc');
                    } else if($sort == 'desc_name') {
                        $query = $query->orderBy('name', 'desc');
                    } else if($sort == 'asc_publisheddate') {
                        $query = $query->whereNotNull('publish_datetime')
                            ->orderBy('publish_datetime', 'asc');
                    } else if($sort == 'desc_publisheddate') {
                        $query = $query->whereNotNull('publish_datetime')
                            ->orderBy('publish_datetime', 'desc');
                    }
                    return  $query;
                })
                ->paginate(9);
        // $blogs = $query;
        // dd($blogs);

        return view('frontend.blog.view_all_blogs', compact('blogs'));
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
        // dd($request->all());
        $saved_blog = $this->blog->create($request->except('_token'));

        $user = User::find($request->user_id);

        if($user->roles[0]->name == 'User') {
            return array('status' => 'success', 'message' => 'Blog progress saved!', 'data' => $saved_blog);
        } else {
            return new RedirectResponse(route('admin.blogs.index'), ['flash_success' => trans('alerts.backend.blogs.created')]);
        }
    }

    /**
     * @param \App\Models\Blogs\Blog                              $blog
     * @param \App\Http\Requests\Backend\Blogs\ManageBlogsRequest $request
     *
     * @return \App\Http\Responses\Backend\Blog\EditResponse
     */
    public function edit(Blog $blog)
    {
        
    }

    /**
     * @param \App\Models\Blogs\Blog                              $blog
     * @param \App\Http\Requests\Backend\Blogs\UpdateBlogsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateBlogsRequest $request, $blog_id)
    {
        // dd($request->all());
        $blog = Blog::find($blog_id);
        $updated_blog = $this->blog->update($blog, $request->except('_token'));

        $user = User::find($request->user_id);

        if($user->roles[0]->name == 'User') {
            return array('status' => 'success', 'message' => 'Blog progress saved!', 'data' => $updated_blog);
        } else {
            return new RedirectResponse(route('admin.blogs.index'), ['flash_success' => trans('alerts.backend.blogs.created')]);
        }
    }

    public function show($id)
    {
        $blog = Blog::find($id);
        // $excerpt_content = Str::limit(preg_replace('#(<figure[^>]*>).*?(</figure>)#', '$1$2', $blog->content), 200);
        // dd($excerpt_content);
        // $excerpt_content = Str::limit($blog->content, 200);
        // $blog->excerpt_content = $excerpt_content;
        if($blog->featured_image == '') {
            $blog->featured_image = 'blog-default-featured-image.png';
        }
        $day = Carbon::parse($blog->publish_datetime)->format('d');
        $blog->day = $day;

        $month = Carbon::parse($blog->publish_datetime)->format('F');
        $year = Carbon::parse($blog->publish_datetime)->format('Y');
        $blog->month = $month;
        $blog->year = $year;
        $videos = $blog->filterVideoLinks();
        $blog->valid_videos = $videos['valid_videos'];
        $blog->invalid_videos = $videos['invalid_videos'];
        $blog->naff_fart_status = $blog->getNaffFartStatus();
        
        return view('frontend.blog.single_blog', compact('blog'));
    }

    /**
     * @param \App\Models\Blogs\Blog                              $blog
     * @param \App\Http\Requests\Backend\Blogs\ManageBlogsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy($id)
    {
        $blog = Blog::find($id)->delete();

        return array('status' => 'success', 'message' => 'Blog deleted successfully!');
    }

    public function publishBlog(UpdateBlogsRequest $request)
    {
        // dd($request->all());
        if($request->blog_id != '') {
            $blog = Blog::find($request->blog_id);
            $saved_blog = $this->blog->update($blog, $request->except('_token'));
        } else {
            $saved_blog = $this->blog->create($request->except('_token'));
        }
        
        $user = User::find($request->user_id);

        if($user->roles[0]->name == 'User') {
            return array('status' => 'success', 'message' => 'Blog published successfully!', 'data' => $saved_blog);
        } else {
            return new RedirectResponse(route('admin.blogs.index'), ['flash_success' => trans('alerts.backend.blogs.created')]);
        }
    }

    public function deleteTrixAttachments(Request $request)
    {
        if($request->attachments != '[]') {
            $formatted_attachments = str_replace( array( '\'', '"', ';', '[', ']' ), '', $request->attachments);
            $attachments = explode(',', $formatted_attachments);

            for($i = 0; $i < count($attachments); $i++) {
                if (Storage::exists('public/trix-attachments/'.$attachments[$i])) {
                    Storage::delete('public/trix-attachments/'.$attachments[$i]);
                }
            }
        }
    }
}
