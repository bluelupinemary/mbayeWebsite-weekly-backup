<?php

namespace App\Http\Controllers\Frontend\Blogs;

use Carbon\Carbon;
use App\Models\Blogs\Blog;
use Illuminate\Support\Str;
use App\Events\NewBlogEvent;
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
use App\Http\Requests\Backend\DesignsBlogs\StoreDesignsBlogsRequest;
use App\Models\BlogShares\BlogShare;
use App\Http\Requests\Backend\BlogShares\StoreBlogSharesRequest;

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

        $regular_blogs = Blog::where('created_by', Auth::user()->id)
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
                }
                
                return  $query;
            })
            ->get();

        if($status == 'Draft' || $status == 'Unpublished') {
            $shared_blogs = [];
        } else {
            $shared_blogs = BlogShare::where('created_by', Auth::user()->id)
            ->whereHas('blog', function($q) use ($search, $sort, $status){
                $q->when($search, function ($query, $search) {
                    return $query->where(function ($q) use ($search) {
                        $q->where('name', 'like', '%'.$search.'%')
                        ->orWhere('content', 'like', '%'.$search.'%');
                    });
                });
             })
             ->orWhereHas('general_blog', function($q) use ($search, $sort, $status){
                $q->when($search, function ($query, $search) {
                    return $query->where(function ($q) use ($search) {
                        $q->where('name', 'like', '%'.$search.'%')
                        ->orWhere('content', 'like', '%'.$search.'%');
                    });
                });
             })
            // ->with('blog')
            ->get();
        }
        
        $blogs = $regular_blogs->merge($shared_blogs)
            ->when($sort, function ($query, $sort) {
                if($sort == 'asc_publisheddate') {
                    $query = $query->whereNotNull('publish_datetime')
                        ->sortBy('publish_datetime');
                } else if($sort == 'desc_publisheddate') {
                    $query = $query->whereNotNull('publish_datetime')
                        ->sortByDesc('publish_datetime');
                }
                return  $query;
            })
            ->when(!$sort, function ($query, $sort) {
                return $query->sortByDesc('publish_datetime');
            })
            ->paginate(9);

	    // dd($data->first()->getTable());
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
        $blog->summary = preg_replace('#(<figure[^>]*>).*?(</figure>)#', '$1$2', $blog->content);
        
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

    public function sharedBlog($share_id)
    {
        $shared_blog = BlogShare::find($share_id);
        $blog = ($shared_blog->blog_type)::find($shared_blog->blog_id);
        // $excerpt_content = Str::limit(preg_replace('#(<figure[^>]*>).*?(</figure>)#', '$1$2', $blog->content), 200);
        // dd($excerpt_content);
        // $excerpt_content = Str::limit($blog->content, 200);
        $blog->summary = preg_replace('#(<figure[^>]*>).*?(</figure>)#', '$1$2', $blog->content);
        
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

        if($shared_blog->blog_type == 'App\Models\Blogs\Blog') {
            $tags = $blog->tags;
        } else if($shared_blog->blog_type == 'App\Models\GeneralBlogs\GeneralBlog') {
            $tags = $shared_blog->tags;
        }
        
        return view('frontend.blog.shared_blog', compact('blog', 'shared_blog', 'tags'));
    }

    /**
     * @param \App\Models\Blogs\Blog                              $blog
     * @param \App\Http\Requests\Backend\Blogs\ManageBlogsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy($id, Request $request)
    {
        if($request->has('type') && $request->type == 'shared') {
            $blog = BlogShare::find($request->share_id)->delete();
        } else {
            $blog = Blog::find($id)->delete();
        }

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
        // dd(compact('saved_blog'));
        broadcast(new NewBlogEvent($saved_blog))->toOthers();
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

    public function shareBlog(StoreBlogSharesRequest $request)
    {
        $blog = Blog::find($request->blog_id);

        $blog_share = new BlogShare();
        $blog_share->caption = $request->share_caption;
        $blog_share->blog_id = $request->blog_id;
        $blog_share->blog_type = $blog->getMorphClass();
        $blog_share->created_by = Auth::user()->id;
        $blog_share->publish_datetime = date('Y-m-d H:i:s');
        $blog_share->save();

        return array('message' => 'Shared blog successfully!');
    }

    public function publishDesignBlog(StoreDesignsBlogsRequest $request)
    {
        // dd($request->all());
        if($request->blog_id != '') {
            $blog = Blog::find($request->blog_id);
            $saved_blog = $this->blog->updateDesignBlog($blog, $request->except('_token'));
        } else {
            $saved_blog = $this->blog->createDesignBlog($request->except('_token'));
        }
        
        $user = User::find($request->user_id);

        if($user->roles[0]->name == 'User') {
            return array('status' => 'success', 'message' => 'Design Blog published successfully!', 'data' => $saved_blog);
        } else {
            return new RedirectResponse(route('admin.blogs.index'), ['flash_success' => trans('alerts.backend.blogs.created')]);
        }
    }

    public function earthlingsActivities(Request $request)
    {
        return view('frontend.blog.activities');
    }

    public function fetchLatestBlogs(Request $request)
    {
        $blogs = Blog::with('owner')->orderBy('publish_datetime', 'desc')->paginate(8);

        return response()->json($blogs);
    }

    public function getTag($tag_name) {
        $tag = BlogTag::where('code', 'like', '%'.$tag_name.'%')->first();

        return $tag->id;
    }

    public function fetchBlogs(Request $request)
    {
        $limit = $request->get('paginate') ? $request->get('paginate') : 21;
        $orderBy = $request->get('orderBy') ? $request->get('orderBy') : 'DESC';
        $sortBy = $request->get('sortBy') ? $request->get('sortBy') : 'created_at';
        $sort = 'desc_name';

        if($request->has('tag') && $request->tag != '') {
            $tag = $this->getTag($request->tag);
            $blogs = Blog::where('status', 'Published')
                ->whereHas('tags', function($q) use($tag) {
                    $q->where('tag_id', $tag);
                })->get();
        } else {
            $blogs = Blog::where('status', 'Published')
                ->whereHas('tags', function($q) {
                    $q->whereNotIn('tag_id', [8,9]);
                })->get();
        }

        $blog_shares = BlogShare::whereIn('blog_id', $blogs->pluck('id')->toArray())->with('blog')->get();

        if($request->has('user_id') && $request->user_id != 0) {
            $blogs = $blogs->where('created_by', $request->user_id);
            $blog_shares = $blog_shares->where('created_by', $request->user_id);
        }
        
        $blogs = $blogs->merge($blog_shares)
                ->sortByDesc('publish_datetime')
                ->paginate($limit);
       
        
        foreach($blogs as $blog){
            if($blog->blog) {
                if($blog->blog->featured_image == '') {
                    $blog->blog->featured_image = 'blog-default-featured-image.png';
                }
                $blog->blog->hotcount  = $blog->blog->likes->where('emotion',0)->count();
                $blog->blog->coolcount     = $blog->blog->likes->where('emotion',1)->count();
                $blog->blog->naffcount     = $blog->blog->likes->where('emotion',2)->count();
                $blog->blog->commentcount  = $blog->blog->comments->count();
                $blog->blog->most_reaction = $blog->blog->mostReaction();
                $blog->blog->name = $blog->caption;
            } else {
                if($blog->featured_image == '') {
                    $blog->featured_image = 'blog-default-featured-image.png';
                }
                $blog->hotcount = $blog->likes->where('emotion',0)->count();
                $blog->coolcount     = $blog->likes->where('emotion',1)->count();
                $blog->naffcount     = $blog->likes->where('emotion',2)->count();
                $blog->commentcount  = $blog->comments->count();
                $blog->most_reaction = $blog->mostReaction();
            }
        }
     
        return response()->json($blogs);
    }
}
