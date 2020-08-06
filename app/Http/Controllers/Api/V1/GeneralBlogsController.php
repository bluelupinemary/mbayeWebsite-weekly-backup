<?php

namespace App\Http\Controllers\Api\V1;

use Backend;
use Validator;
use App\Models\Blogs\Blog;
use Illuminate\Http\Request;
use App\Models\Like\GeneralLike;
use Illuminate\Support\Facades\DB;
use App\Models\Comment\GeneralComment;
use App\Models\GeneralBlogs\GeneralBlog;
use App\Models\GeneralBlogShares\GeneralBlogShare;
use App\Http\Resources\GeneralBlogsResource;
use App\Repositories\Frontend\GeneralBlogs\GeneralBlogsRepository;
use App\Models\Comment\Comment;
use Carbon\Carbon;

// use App\Models\Like\Like;
class GeneralBlogsController extends APIController
{
    protected $repository;

    /**
     * __construct.
     *
     * @param $repository
     */
    public function __construct(GeneralBlogsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Return the blogs.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
   
        $limit = $request->get('paginate') ? $request->get('paginate') : 14;
        $orderBy = $request->get('orderBy') ? $request->get('orderBy') : 'DESC';
        $sortBy = $request->get('sortBy') ? $request->get('sortBy') : 'created_at';

        return GeneralBlogsResource::collection(
            $this->repository->getForDataTable()->orderBy($sortBy, $orderBy)->paginate($limit)
        );
    }
    /**
     * Returns all general blogs
     */
    public function fetchgeneralblogs(Request $request)
    {
   
        $limit = $request->get('paginate') ? $request->get('paginate') : 21;
        $orderBy = $request->get('orderBy') ? $request->get('orderBy') : 'DESC';
        $sortBy = $request->get('sortBy') ? $request->get('sortBy') : 'created_at';
        $sort = 'desc_name';
        $general_blogs = GeneralBlog::get();
        $general_blog_shares = GeneralBlogShare::where('publish_datetime', '>=', Carbon::now()->subDay())->with('blog')->get();

        if($request->has('user_id') && $request->user_id != 0) {
            $general_blogs = $general_blogs->where('created_by', $request->user_id);
            $general_blog_shares = $general_blog_shares->where('created_by', $request->user_id);
        }                         
        
        $blogs = $general_blogs->merge($general_blog_shares)
                ->sortByDesc('publish_datetime')
                ->paginate($limit);
       
        
        foreach($blogs as $blog){
            if($blog->blog) {
                $blog->blog->hotcount  = $blog->blog->likes->where('emotion',0)->count();
                $blog->blog->coolcount     = $blog->blog->likes->where('emotion',1)->count();
                $blog->blog->naffcount     = $blog->blog->likes->where('emotion',2)->count();
                $blog->blog->commentcount  = $blog->blog->comments->count();
                $blog->blog->most_reaction = $blog->blog->mostReaction();
            } else {
                $blog->hotcount = $blog->likes->where('emotion',0)->count();
                $blog->coolcount     = $blog->likes->where('emotion',1)->count();
                $blog->naffcount     = $blog->likes->where('emotion',2)->count();
                $blog->commentcount  = $blog->comments->count();
                $blog->most_reaction = $blog->mostReaction();
            }
        }
     
        return response()->json($blogs);
    }

    /**
     * Returns all general blog userwise
     */
    public function show_generalblog_userwise(Request $request){
        $id=$request['id']; 
        $limit = $request->get('paginate') ? $request->get('paginate') : 14;
        $orderBy = $request->get('orderBy') ? $request->get('orderBy') : 'DESC';
        $sortBy = $request->get('sortBy') ? $request->get('sortBy') : 'created_at';
        $general_blogs = DB::table('general_blogs')->where('general_blogs.created_by', $id)->get();
        $general_blog_shares = DB::table('general_blog_shares')->where('general_blog_shares.created_by', $id)->get();
      
          if(count($general_blog_shares)>0)
            {
            foreach($general_blog_shares as $key=>$value){
                $blog_id[] = $general_blog_shares[$key]->general_blog_id;
            }

            $blogs_shared = DB::table('general_blogs')
                        ->whereIn('id',  $blog_id)
                        ->get();
            if(count($blogs_shared)>0)
                {
                    foreach($blogs_shared as $key=>$value){
                        $blogs_shared[$key]->shared  = 'shared';
                         }
                } 
            $blogs = $general_blogs->merge($blogs_shared)
                        ->sortByDesc('created_at')
                        ->paginate($limit);
            }   
            else
                    $blogs = $general_blogs ->paginate($limit);
                    
                foreach($blogs as $key=>$value){
                $blogs[$key]->thumb         ='/storage/img/general_blogs/'. $blogs[$key]->featured_image;
                $blogs[$key]->hotcount      = GeneralLike::where('blog_id', $blogs[$key]->id)->where('emotion',0)->count();
                $blogs[$key]->coolcount     = GeneralLike::where('blog_id', $blogs[$key]->id)->where('emotion',1)->count();
                $blogs[$key]->naffcount     = GeneralLike::where('blog_id', $blogs[$key]->id)->where('emotion',2)->count();
                $blogs[$key]->commentcount  = GeneralComment::where('blog_id', $blogs[$key]->id)->count();
            }
    
        return response()->json($blogs);   
}
    /**
     * Return the specified resource.
     *
     * @param GeneralBlog GeneralBlog
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(GeneralBlog $generalblog)
    {
        return new GeneralBlogsResource($generalblog);
    }

    /**
     * Creates the Resource for Blog.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validation = $this->validateBlog($request);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $this->repository->create($request->all());

        return new GeneralBlogsResource(GeneralBlog::orderBy('created_at', 'desc')->first());
    }

    /**
     * Update blog.
     *
     * @param Blog    $blog
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Blog $blog)
    {
        $validation = $this->validateBlog($request, 'update');

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $this->repository->update($blog, $request->all());

        $blog = Blog::findOrfail($blog->id);

        return new GeneralBlogsResource($blog);
    }

    /**
     * Delete Blog.
     *
     * @param Blog    $blog
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Blog $blog, Request $request)
    {
        $this->repository->delete($blog);

        return $this->respond([
            'message' => trans('alerts.backend.blogs.deleted'),
        ]);
    }


    /**
     * validate Blog.
     *
     * @param $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function validateBlog(Request $request, $action = 'insert')
    {
        $featured_image = ($action == 'insert') ? 'required' : '';

        $publish_datetime = $request->publish_datetime !== '' ? 'required|date' : 'required';

        $validation = Validator::make($request->all(), [
            'name'              => 'required|max:191',
            'featured_image'    => $featured_image,
            'publish_datetime'  => $publish_datetime,
            'content'           => 'required',
            'categories'        => 'required',
            'tags'              => 'required',
            'thumb'             =>  $featured_image,
        ]);

        return $validation;
    }

    /**
     * validate message for validate blog.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function messages()
    {
        return [
            'name.required' => 'Please insert Blog Title',
            'name.max'      => 'Blog Title may not be greater than 191 characters.',
        ];
    }
}
