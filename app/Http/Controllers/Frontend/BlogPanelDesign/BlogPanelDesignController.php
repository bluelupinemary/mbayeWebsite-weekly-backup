<?php

namespace App\Http\Controllers\Frontend\BlogPanelDesign;

use Carbon\Carbon;
use App\Models\BlogDesignPanels\BlogDesignPanel;
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
use App\Repositories\Frontend\BlogPanelDesign\BlogPanelDesignRepository;
use App\Http\Requests\Backend\Blogs\StoreBlogsRequest;
use App\Http\Requests\Backend\Blogs\ManageBlogsRequest;
use App\Http\Requests\Backend\Blogs\UpdateBlogsRequest;

/**
 * Class BlogsController.
 */
class BlogPanelDesignController extends Controller
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
     * @var BlogPanelDesignRepository
     */
    protected $generalblog;

    /**
     * @param \App\Repositories\Backend\Blogs\BlogPanelDesignRepository $generalblog
     */
    public function __construct(BlogPanelDesignRepository $generalblog)
    {
        $this->blog = $generalblog;
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
        
        return view('frontend.blog.single_general_blog', compact('blog'));
    }

    
}
