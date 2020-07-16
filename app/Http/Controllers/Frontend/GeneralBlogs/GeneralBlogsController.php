<?php

namespace App\Http\Controllers\Frontend\GeneralBlogs;

use Carbon\Carbon;
use App\Models\GeneralBlogs\GeneralBlog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Access\User\User;
use App\Models\BlogTags\BlogTag;
use App\Models\GeneralBlogShares\GeneralBlogShare;
use App\Models\BlogShares\BlogShare;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\Backend\Blog\EditResponse;
use App\Http\Responses\Backend\Blog\IndexResponse;
use App\Http\Responses\Backend\Blog\CreateResponse;
use App\Repositories\Frontend\GeneralBlogs\GeneralBlogsRepository;
use App\Http\Requests\Backend\Blogs\StoreBlogsRequest;
use App\Http\Requests\Backend\Blogs\ManageBlogsRequest;
use App\Http\Requests\Backend\Blogs\UpdateBlogsRequest;
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
        if($request->share_as_permanent == '1') {
            $blog = GeneralBlog::find($request->blog_id);
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
        } else {
            $blog_share = new GeneralBlogShare();
            $blog_share->caption = $request->share_caption;
            $blog_share->general_blog_id = $request->blog_id;
            $blog_share->created_by = Auth::user()->id;
            $blog_share->publish_datetime = date('Y-m-d H:i:s');
            $blog_share->save();
        }
        
        return array('message' => 'Shared blog successfully!');
    }
}
