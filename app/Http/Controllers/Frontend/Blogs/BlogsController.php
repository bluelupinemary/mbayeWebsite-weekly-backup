<?php

namespace App\Http\Controllers\Frontend\Blogs;

use Carbon\Carbon;
use App\Models\Blogs\Blog;
use Illuminate\Support\Str;
use App\Events\NewBlogEvent;
use Illuminate\Http\Request;
use App\Models\Access\User\User;
use App\Models\BlogTags\BlogTag;
use App\Events\DesignPanelBlogEvent;
use App\Http\Controllers\Controller;
use App\Models\BlogShares\BlogShare;
use Illuminate\Support\Facades\Auth;
use App\Http\Responses\RedirectResponse;
use App\Models\GeneralBlogs\GeneralBlog;
use Illuminate\Support\Facades\Notification;
use App\Http\Responses\Backend\Blog\EditResponse;
use App\Http\Responses\Backend\Blog\IndexResponse;
use App\Models\Friendships\FriendFriendshipGroups;
use App\Http\Responses\Backend\Blog\CreateResponse;
use App\Repositories\Frontend\Blogs\BlogsRepository;
use App\Notifications\Frontend\BlogShareNotification;
use App\Http\Requests\Backend\Blogs\StoreBlogsRequest;
use App\Http\Requests\Backend\Blogs\ManageBlogsRequest;
use App\Http\Requests\Backend\Blogs\UpdateBlogsRequest;
use App\Notifications\Frontend\BlogActivityNotification;
use App\Http\Requests\Backend\BlogShares\StoreBlogSharesRequest;
use App\Http\Requests\Backend\DesignsBlogs\StoreDesignsBlogsRequest;

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

        // $user = User::find($request->user_id);

        // if($user->roles[0]->name == 'User') {
        //     return array('status' => 'success', 'message' => 'Blog progress saved!', 'data' => $saved_blog);
        // } else {
        //     return new RedirectResponse(route('admin.blogs.index'), ['flash_success' => trans('alerts.backend.blogs.created')]);
        // }
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

            // get blog privacy group_id
            $group_ids = $saved_blog->privacy->pluck('group_id')->toArray();

            if($group_ids) {
                $user_ids = FriendFriendshipGroups::whereIn('group_id', $group_ids)->pluck('friend_id')->toArray();

                $friends = User::whereIn('id', $user_ids)->get();
            } else {
                $friends = Auth::user()->getFriends();
            }
            
            Notification::send($friends, new BlogActivityNotification($saved_blog));
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
        $user = User::find($blog->created_by)->get();
        $blog_share = new BlogShare();
        $blog_share->caption = $request->share_caption;
        $blog_share->blog_id = $request->blog_id;
        $blog_share->blog_type = $blog->getMorphClass();
        $blog_share->created_by = Auth::user()->id;
        $blog_share->publish_datetime = date('Y-m-d H:i:s');
        $blog_share->save();
        Notification::send($user, new BlogShareNotification($blog_share));
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
        broadcast(new DesignPanelBlogEvent($saved_blog))->toOthers();
        $friends = Auth::user()->getFriends();
        Notification::send($friends, new BlogActivityNotification($saved_blog));
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
        $friends = Auth::user()->getFriends();
        $friendships = Auth::user()->getAcceptedFriendships();
        $fsid = $friendships->pluck('id');
        $fid = $friends->pluck('id');
        $groups = FriendFriendshipGroups::whereIn('friendship_id',$fsid)->pluck("group_id");
        // $blogs = Blog::with('owner')->orderBy('publish_datetime', 'desc');
        $blogs_private = Blog::whereIn('created_by', $fid)->whereHas('privacy', function($q) use ($groups) {
            $q->whereIn('group_id', $groups);
        })->get();
        $blogs_public = Blog::whereIn('created_by', $fid)->doesntHave('privacy')->get();
        // dd(compact('general_blogs_private'));
        $general_blogs_private = GeneralBlog::whereIn('created_by', $fid)->whereHas('privacy', function($q) use ($groups) {
            $q->whereIn('group_id', $groups);
        })->get();
        // dd($general_blogs_private);
        $general_blogs_public = GeneralBlog::whereIn('created_by', $fid)->doesntHave('privacy')->get();
        // dd(compact('general_blogs_private'));
        $reguler_blogs = $blogs_private->merge($blogs_public);
        $general_blogs = $general_blogs_private->merge($general_blogs_public);
        $blogs = $reguler_blogs->merge($general_blogs)
        ->sortByDesc('publish_datetime')
        ->paginate(8);
        // dd($blogs);
        // $blogs = Blog::with(['owner', 'tags'])->orderBy('publish_datetime', 'desc')->paginate(8);

        return response()->json($blogs);
    }

    public function getTag($tag_name) {
        $tag = BlogTag::where('code', 'like', '%'.$tag_name.'%')->first();

        return $tag->id;
    }

    public function fetchBlogs(Request $request)
    {
        $limit = $request->get('paginate') ? $request->get('paginate') : 5;
        $orderBy = $request->get('orderBy') ? $request->get('orderBy') : 'DESC';
        $sortBy = $request->get('sortBy') ? $request->get('sortBy') : 'created_at';
        $sort = 'desc_name';

        $friendships = Auth::user()->getAcceptedFriendships();
        $fsid = $friendships->pluck('id');
        $groups = FriendFriendshipGroups::whereIn('friendship_id',$fsid)->pluck("group_id");

        if($request->has('tag') && $request->tag != '') {
            $tag = $this->getTag($request->tag);
            $private_blogs = Blog::where('status', 'Published')
                ->whereHas('tags', function($q) use($tag) {
                    $q->where('tag_id', $tag);
                })->whereHas('privacy', function($q) use ($groups) {
                    $q->whereIn('group_id', $groups);
                })->get();
            $public_blogs  = Blog::where('status', 'Published')
                ->whereHas('tags', function($q) use($tag) {
                    $q->where('tag_id', $tag);
                })->doesntHave('privacy')->get();
            // dd($public_blogs);
        } else {
            $private_blogs = Blog::where('status', 'Published')
                ->whereHas('tags', function($q) {
                    $q->whereNotIn('tag_id', [8,9]);
                })->whereHas('privacy', function($q) use ($groups) {
                    $q->whereIn('group_id', $groups);
                })->get();

            $public_blogs = Blog::where('status', 'Published')
                ->whereHas('tags', function($q) {
                    $q->whereNotIn('tag_id', [8,9]);
                })->doesntHave('privacy')->get();
        }

        $blog_shares = $this->getSharedBlogs($request->tag);

        if($request->has('user_id') && $request->user_id != 0) {
            $public_blogs = $public_blogs->where('created_by', $request->user_id);
            $private_blogs = $private_blogs->where('created_by', $request->user_id);
            $blog_shares = $blog_shares->where('created_by', $request->user_id);
        } else if($request->has('user_id') && $request->user_id == 0 && $request->type == 'friend') {
            $friends_id = Auth::user()->getFriends()->pluck('id')->toArray();
            
            $public_blogs = $public_blogs->whereIn('created_by', $friends_id);
            $private_blogs = $private_blogs->whereIn('created_by', $friends_id);
            $blog_shares = $blog_shares->whereIn('created_by', $friends_id);
        }

        $page = 1; 

        if($request->has('page') && $request->page >= 1) {
            $page = $request->page;
        }
        
        $blogs = $private_blogs->merge($public_blogs);
        $plus_shared_blogs = $blogs->merge($blog_shares)->sortByDesc('publish_datetime');
        $last_page = ceil($plus_shared_blogs->count() / $limit);
        $total = $plus_shared_blogs->count();
        $paginated = $plus_shared_blogs->forPage($page, $limit);
        $to = $paginated->count();
        
        // foreach($blogs as $blog){
        //     if($blog->blog_type) {
        //         if($blog->blog_type == 'App\Models\Blogs\Blog') {
        //             if($blog->blog->featured_image == '') {
        //                 $blog->blog->featured_image = '/storage/img/blog/blog-default-featured-image.png';
        //             } else {
        //                 $blog->blog->featured_image = '/storage/img/blog/'.$blog->blog->featured_image;
        //             }

        //             $blog->blog->owner = $blog->blog->owner;
        //             $blog->blog->hotcount  = $blog->blog->likes->where('emotion',0)->count();
        //             $blog->blog->coolcount     = $blog->blog->likes->where('emotion',1)->count();
        //             $blog->blog->naffcount     = $blog->blog->likes->where('emotion',2)->count();
        //             $blog->blog->commentcount  = $blog->blog->comments->count();
        //             $blog->blog->most_reaction = $blog->blog->mostReaction();
        //             // $blog->blog->name = $blog->caption;
        //         } else if($blog->blog_type == 'App\Models\GeneralBlogs\GeneralBlog') {
        //             $blog->blog = $blog->general_blog;
                    
        //             if($blog->general_blog->featured_image == '') {
        //                 $blog->blog->featured_image = 'blog/blog-default-featured-image.png';
        //             } else {
        //                 $blog->blog->featured_image = 'general_blogs/'.$blog->general_blog->featured_image;
        //             }

        //             $blog->blog->owner = $blog->general_blog->owner;
        //             $blog->blog->hotcount  = $blog->general_blog->likes->where('emotion',0)->count();
        //             $blog->blog->coolcount     = $blog->general_blog->likes->where('emotion',1)->count();
        //             $blog->blog->naffcount     = $blog->general_blog->likes->where('emotion',2)->count();
        //             $blog->blog->commentcount  = $blog->general_blog->comments->count();
        //             $blog->blog->most_reaction = $blog->general_blog->mostReaction();
        //             // $blog->blog->name = $blog->caption;
        //         }
        //         $blog->blog->hotcount  = $blog->blog->likes->where('emotion',0)->count();
        //         $blog->blog->coolcount     = $blog->blog->likes->where('emotion',1)->count();
        //         $blog->blog->naffcount     = $blog->blog->likes->where('emotion',2)->count();
        //         $blog->blog->commentcount  = $blog->blog->comments->count();
        //         $blog->blog->most_reaction = $blog->blog->mostReaction();
        //         $blog->blog->name = $blog->caption;
        //     } else {
        //         if($blog->featured_image == '') {
        //             $blog->featured_image = 'blog/blog-default-featured-image.png';
        //         }
        //         $blog->hotcount = $blog->likes->where('emotion',0)->count();
        //         $blog->coolcount     = $blog->likes->where('emotion',1)->count();
        //         $blog->naffcount     = $blog->likes->where('emotion',2)->count();
        //         $blog->commentcount  = $blog->comments->count();
        //         $blog->most_reaction = $blog->mostReaction();
        //     }
        // }
     
        return response()->json(['data' => $paginated->values()->all(), 'current_page' => $page, 'last_page' => $last_page, 'total' => $total, 'to' => $to]);
    }

    public function getSharedBlogs($tag)
    {
        if($tag && $tag != '') {
            $tag = $this->getTag($tag);
            $from_general_blog = BlogShare::where('blog_type', 'App\Models\GeneralBlogs\GeneralBlog')
                ->whereHas('tags', function($q) use($tag) {
                    $q->where('tag_id', $tag);
                })
                ->get();

            $from_reg_blog = BlogShare::where('blog_type', 'App\Models\Blogs\Blog')
                ->whereHas('blog', function($q) use($tag) {
                    $q->whereHas('tags', function($query) use($tag) {
                        $query->where('tag_id', $tag);
                    });
                })
                ->get();
        } else {
            $from_general_blog = BlogShare::where('blog_type', 'App\Models\GeneralBlogs\GeneralBlog')
                ->whereHas('tags', function($q) use($tag) {
                    $q->whereNotIn('tag_id', [8,9]);
                })
                ->get();

            $from_reg_blog = BlogShare::where('blog_type', 'App\Models\Blogs\Blog')
                ->whereHas('blog', function($q) use($tag) {
                    $q->whereHas('tags', function($query) use($tag) {
                        $query->whereNotIn('tag_id', [8,9]);
                    });
                })
                ->get();
        }

        $share_blogs = $from_general_blog->merge($from_reg_blog);

        return $share_blogs;
    }
}
