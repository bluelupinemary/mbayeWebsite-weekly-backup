<?php

namespace App\Http\Controllers\Frontend\GeneralBlogs;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Events\GeneralBlogEvent;
use App\Models\Access\User\User;
use App\Models\BlogTags\BlogTag;
use App\Http\Controllers\Controller;
use App\Models\BlogShares\BlogShare;
use Illuminate\Support\Facades\Auth;
use App\Http\Responses\RedirectResponse;
use App\Models\GeneralBlogs\GeneralBlog;
use Illuminate\Support\Facades\Notification;
use App\Models\Friendships\FriendFriendshipGroups;
use App\Models\GeneralBlogShares\GeneralBlogShare;
use App\Notifications\Frontend\BlogActivityNotification;
use App\Notifications\Frontend\BlogShareNotification;
use App\Notifications\Frontend\GeneralBlogShareNotification;
use App\Notifications\Frontend\GeneralBlogActivityNotification;
use App\Repositories\Frontend\GeneralBlogs\GeneralBlogsRepository;
// use App\Http\Requests\Backend\GeneralBlogs\StoreGeneralBlogsRequest;
use App\Http\Requests\Backend\GeneralBlogShares\StoreGeneralBlogSharesRequest;

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
        'Unpublished' => 'Unpublished',
    ];

    /**
     * @var GeneralBlogsRepository
     */
    protected $generalblog;

    /**
     * @param \App\Repositories\Backend\Blogs\GeneralBlogsRepository $generalblog
     */
    public function __construct(GeneralBlogsRepository $generalblog)
    {
        $this->blog = $generalblog;
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
        // dd(Carbon::now()->subDay());

        $stories = GeneralBlog::where('created_by', Auth::user()->id)
            ->where('publish_datetime', '>=', Carbon::now()->subDay())
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

        
        $shared_stories = GeneralBlogShare::where('created_by', Auth::user()->id)
            ->where('publish_datetime', '>=', Carbon::now()->subDay())
            ->whereHas('blog', function($q) use ($search, $sort, $status){
                $q->when($search, function ($query, $search) {
                    return $query->where(function ($q) use ($search) {
                        $q->where('name', 'like', '%'.$search.'%')
                        ->orWhere('content', 'like', '%'.$search.'%');
                    });
                });
            })
            ->with('blog')
            ->get();
        

        if($status == '') {
            $blogs = $stories->merge($shared_stories);
        } else if($status == 'Published') {
            $blogs = $stories;
        } else if($status == 'Shared') {
            $blogs = $shared_stories;
        }

        $blogs = $blogs->when($sort, function ($query, $sort) {
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
        

        // $alert = false;

        // if(!$request->has(['search', 'sort', 'status'])) {
            $alert = $this->hasExpiringStories($blogs);
        // }

        // dd($alert);
        return view('frontend.blog.view_all_stories', compact('blogs', 'alert'));
    }

    /**
     * Returns all general blogs
     */
    public function fetchgeneralblogs(Request $request)
    {
        $friends = Auth::user()->getFriends();
        $friendships = Auth::user()->getAcceptedFriendships();
        $fsid = $friendships->pluck('id');
        $fid = $friends->pluck('id');
        $groups = FriendFriendshipGroups::whereIn('friendship_id',$fsid)->pluck("group_id");
        // dd($groups);
        $limit = $request->get('paginate') ? $request->get('paginate') : 5;
        $orderBy = $request->get('orderBy') ? $request->get('orderBy') : 'DESC';
        $sortBy = $request->get('sortBy') ? $request->get('sortBy') : 'created_at';
        $sort = 'desc_name';
        $general_blogs_private = GeneralBlog::whereHas('privacy', function($q) use ($groups) {
            $q->whereIn('group_id', $groups);
        })->get();
        // dd($general_blogs_private);
        $general_blogs_public = GeneralBlog::doesntHave('privacy')->get();
        // dd(compact('general_blogs_public'));
        $general_blog_shares = GeneralBlogShare::with('blog')->get();

        if($request->has('user_id') && $request->user_id != 0) {
            $general_blogs_private = $general_blogs_private->where('created_by',$request->user_id);
            $general_blogs_public = $general_blogs_public->where('created_by',$request->user_id);
            $general_blog_shares = $general_blog_shares->where('created_by', $request->user_id);
        } else if($request->has('user_id') && $request->user_id == 0 && $request->type == 'friend') {
            $friends_id = Auth::user()->getFriends()->pluck('id')->toArray();
            
            $general_blogs_private = $general_blogs_private->whereIn('created_by', $friends_id);
            $general_blogs_public = $general_blogs_public->whereIn('created_by', $friends_id);
            $general_blog_shares = $general_blog_shares->whereIn('created_by', $friends_id);
        }        
        
        $page = 1; 

        if($request->has('page') && $request->page >= 1) {
            $page = $request->page;
        }
        
        $general_blogs = $general_blogs_private->merge($general_blogs_public);
        $plus_shared_blogs = $general_blogs->merge($general_blog_shares)->sortByDesc('publish_datetime');
        $last_page = ceil($plus_shared_blogs->count() / $limit);
        $total = $plus_shared_blogs->count();
        $paginated = $plus_shared_blogs->forPage($page, $limit);
        $to = $paginated->count();

        // dd($plus_shared_blogs);
        // $sorted = $blogs->sortByDesc('publish_datetime')->paginate($limit);
        
        // foreach($sorted as $blog){
        //     if($blog->blog) {
        //         if($blog->blog->featured_image == '') {
        //             $blog->blog->featured_image = 'blog-default-featured-image.png';
        //         }
        //         $blog->blog->owner = $blog->blog->owner;
        //         $blog->blog->hotcount  = $blog->blog->likes->where('emotion',0)->count();
        //         $blog->blog->coolcount     = $blog->blog->likes->where('emotion',1)->count();
        //         $blog->blog->naffcount     = $blog->blog->likes->where('emotion',2)->count();
        //         $blog->blog->commentcount  = $blog->blog->comments->count();
        //         $blog->blog->most_reaction = $blog->blog->mostReaction();
        //         // $blog->blog->name = $blog->caption;
        //     } else {
        //         $blog->hotcount      = $blog->likes->where('emotion',0)->count();
        //         $blog->coolcount     = $blog->likes->where('emotion',1)->count();
        //         $blog->naffcount     = $blog->likes->where('emotion',2)->count();
        //         $blog->commentcount  = $blog->comments->count();
        //         $blog->most_reaction = $blog->mostReaction();
        //     }
        // }
     
        return response()->json(['data' => $paginated->values()->all(), 'current_page' => $page, 'last_page' => $last_page, 'total' => $total, 'to' => $to]);
    }

    public function mostNaffed(Request $request)
    {
        $blogs = GeneralBlog::withCount('naffLikes')
            ->having('naff_likes_count', '>', 0)
            ->orderBy('naff_likes_count', 'desc')
            ->limit(50)
            ->get();

        return response()->json($blogs);
    }

    public function show($id)
    {
        $blog = GeneralBlog::find($id);
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

        $tags = BlogTag::whereNotIn('id', ['8','9'])->get();
        
        return view('frontend.blog.single_general_blog', compact('blog', 'tags'));
    }

    public function saveGeneralBlog(Request $request)
    {
        if($request->blog_id != '') {
            $blog = GeneralBlog::find($request->blog_id);
            $saved_blog = $this->blog->updateGeneralBlog($blog, $request->except('_token'));
        } else {
            $saved_blog = $this->blog->createGeneralBlog($request->except('_token'));

            // get blog privacy group_id
            $group_ids = $saved_blog->privacy->pluck('group_id')->toArray();

            if($group_ids) {
                $user_ids = FriendFriendshipGroups::whereIn('group_id', $group_ids)->pluck('friend_id')->toArray();

                $friends = User::whereIn('id', $user_ids)->get();
            } else {
                $friends = Auth::user()->getFriends();
            }
            
            Notification::send($friends, new GeneralBlogActivityNotification($saved_blog));
        }
        
        broadcast(new GeneralBlogEvent($saved_blog))->toOthers();
        // $friends = Auth::user()->getFriends();
        // Notification::send($friends, new BlogActivityNotification($saved_blog));
        
        $user = User::find($request->user_id);

        if($user->roles[0]->name == 'User') {
            return array('status' => 'success', 'message' => 'Blog published successfully!', 'data' => $saved_blog);
        } else {
            return new RedirectResponse(route('admin.blogs.index'), ['flash_success' => trans('alerts.backend.blogs.created')]);
        }
    }

    public function sharedStory($share_id)
    {
        $shared_blog = GeneralBlogShare::find($share_id);
        $blog = GeneralBlog::find($shared_blog->general_blog_id);
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

        $tags = BlogTag::whereNotIn('id', ['8','9'])->get();
        
        return view('frontend.blog.shared_story', compact('blog', 'tags', 'shared_blog'));
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
            $blog = GeneralBlogShare::find($request->share_id)->delete();
        } else {
            $blog = GeneralBlog::find($id)->delete();
        }

        return array('status' => 'success', 'message' => 'Blog deleted successfully!');
    }

    public function shareBlog(StoreGeneralBlogSharesRequest $request)
    {
        $blog = GeneralBlog::find($request->blog_id);
        $user = $blog->owner;

        if($request->share_as_permanent == '1') {
            $tags = $request->tag_ids;
            
            $blog_share = new BlogShare();
            $blog_share->caption = $request->share_caption;
            $blog_share->blog_id = $request->blog_id;
            $blog_share->blog_type = $blog->getMorphClass();
            $blog_share->created_by = Auth::user()->id;
            $blog_share->publish_datetime = date('Y-m-d H:i:s');
            $blog_share->save();
            

            if (count($tags)) {
                $blog_share->tags()->sync($tags);
            }

            Notification::send($user, new BlogShareNotification($blog_share));
        } else {
            $blog_share = new GeneralBlogShare();
            $blog_share->caption = $request->share_caption;
            $blog_share->general_blog_id = $request->blog_id;
            $blog_share->created_by = Auth::user()->id;
            $blog_share->publish_datetime = date('Y-m-d H:i:s');
            $blog_share->save();

            Notification::send($user, new GeneralBlogShareNotification($blog_share));
        }
        
        return array('message' => 'Shared blog successfully!', 'blog_share' => $blog_share, 'permanent' => $request->share_as_permanent);
    }

    public function hasExpiringStories($stories)
    {
        $expiring = false;

        foreach($stories as $story) {
            if($story->isNearlyExpired()) {
                $expiring = true;
            }
        }

        return $expiring;
    }

    public function getgeneralblogs(Request $request)
    {
        $search = $request->search;
        $sort = $request->sort;
        $status = $request->status;
        // dd(Carbon::now()->subDay());

        $stories = GeneralBlog::where('created_by', Auth::user()->id)
            // ->where('publish_datetime', '>=', Carbon::now()->subDay())
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

        
        $shared_stories = GeneralBlogShare::where('created_by', Auth::user()->id)
            // ->where('publish_datetime', '>=', Carbon::now()->subDay())
            ->whereHas('blog', function($q) use ($search, $sort, $status){
                $q->when($search, function ($query, $search) {
                    return $query->where(function ($q) use ($search) {
                        $q->where('name', 'like', '%'.$search.'%')
                        ->orWhere('content', 'like', '%'.$search.'%');
                    });
                });
            })
            ->with('blog')
            ->get();
        

        if($status == '') {
            $blogs = $stories->merge($shared_stories);
        } else if($status == 'Published') {
            $blogs = $stories;
        } else if($status == 'Shared') {
            $blogs = $shared_stories;
        }

        $blogs = $blogs->when($sort, function ($query, $sort) {
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
        ->paginate(2);
        

        // // $alert = false;

        // // if(!$request->has(['search', 'sort', 'status'])) {
        //     $alert = $this->hasExpiringStories($blogs);
        // // }

        // dd($alert);
        return $blogs;
    }
}
