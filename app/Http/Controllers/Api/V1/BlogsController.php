<?php

namespace App\Http\Controllers\Api\V1;

use Validator;
use App\Models\Like\Like;
use App\Models\Blogs\Blog;
use Illuminate\Http\Request;
use App\Models\Comment\Comment;
use App\Models\Access\User\User;
use App\Models\BlogTags\BlogTag;
use Illuminate\Support\Facades\DB;
use App\Models\BlogTags\BlogMapTag;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\BlogsResource;
use App\Models\BlogPrivacy\BlogPrivacy;
use App\Http\Resources\GeneralBlogsResource;
use App\Models\Friendships\FriendFriendshipGroups;
use App\Repositories\Frontend\Blogs\BlogsRepository;

class BlogsController extends APIController
{
    protected $repository;

    /**
     * __construct.
     *
     * @param $repository
     */
    public function __construct(BlogsRepository $repository)
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
       // $limit = $request->get('paginate') ? $request->get('paginate') : 100;
        $limit = $request->get('paginate') ? $request->get('paginate') : 21;
        $orderBy = $request->get('orderBy') ? $request->get('orderBy') : 'DESC';
        $sortBy = $request->get('sortBy') ? $request->get('sortBy') : 'created_at';

        return BlogsResource::collection(
            $this->repository->getForDataTable()->orderBy($sortBy, $orderBy)->paginate($limit)
        );
    }
    /**
     * 
     */
    public function showbytag(Request $request)
    {
       
        $btag = BlogTag::where('name',$request['blogtag'])->first();

        $limit = $request->get('paginate') ? $request->get('paginate') : 21;
        $orderBy = $request->get('orderBy') ? $request->get('orderBy') : 'DESC';
        $sortBy = $request->get('sortBy') ? $request->get('sortBy') : 'created_at';
    
        // return BlogsResource::collection(
        //     $btag->blogs()->orderBy($sortBy, $orderBy)->paginate($limit)
        // );

          $blogs = DB::table('blogs')
                ->join('blog_map_tags','blog_map_tags.blog_id','=','blogs.id')
                ->select('blogs.*')
                ->where('blog_map_tags.tag_id',$btag->id)
                ->paginate($limit);

          $blog_shares = DB::table('blog_shares')->get();
          if(count($blog_shares)>0)
          {
                foreach($blog_shares as $key=>$value){
                    $blog_id[] = $blog_shares[$key]->blog_id;
                }
          
            $blogs_shared = DB::table('blogs')
                ->join('blog_map_tags','blog_map_tags.blog_id','=','blogs.id')
                ->select('blogs.*')
                ->whereIn('blogs.id',  $blog_id)
                ->orwhere('blog_map_tags.tag_id',$btag->id)
                ->get();  
              

                
                if(count($blogs_shared)>0)
                {
                    foreach($blogs_shared as $key=>$value){
                        $blogs_shared[$key]->shared  = 'shared';
                        } 
                }
        $all_blogs = $blogs->merge($blogs_shared)
        ->sortByDesc('created_at')
        ->paginate($limit);
           }
           foreach($all_blogs as $key=>$value){
            $all_blogs[$key]->thumb         ='/storage/img/blog/'. $all_blogs[$key]->featured_image;
            $all_blogs[$key]->hotcount      = Like::where('blog_id', $all_blogs[$key]->id)->where('emotion',0)->count();
            $all_blogs[$key]->coolcount     = Like::where('blog_id', $all_blogs[$key]->id)->where('emotion',1)->count();
            $all_blogs[$key]->naffcount     =Like::where('blog_id', $all_blogs[$key]->id)->where('emotion',2)->count();
            $all_blogs[$key]->commentcount  = Comment::where('blog_id', $all_blogs[$key]->id)->count();
          }
     
        return response()->json($all_blogs);
         
    }
    public function showbytagforfriend(Request $request){
            $user = User::find($request['id']);
            $auth = User::find($request['user']);
            $friendship = $user->getFriendship($auth);
            $groups = FriendFriendshipGroups::where('friend_id',$auth->id)->where('friendship_id',$friendship->id)->pluck("group_id");
            // dd($groups);
            // $f = $auth->isFriendWith($user);
            // if($auth->isFriendWith($user)){
            //     $groups = $user->getGroups();
            //     dd($groups);
            // }else{
            //     dd('no friendship');
            // }
 
            $btag = BlogTag::where('name',$request['tag'])->first();
            $id=$request['id'];
            $blogs_private = $btag->blogs()->where('created_by', $id)->whereHas('privacy', function($q) use ($groups) {
                $q->whereIn('group_id', $groups);
            })->get();
            // dd($blogs_private);
            $blogs_public = $btag->blogs()->where('created_by', $id)->doesntHave('privacy')->get();

            // dd($blogs_public); 
            
            $limit = $request->get('paginate') ? $request->get('paginate') : 21;
            $orderBy = $request->get('orderBy') ? $request->get('orderBy') : 'DESC';
            $sortBy = $request->get('sortBy') ? $request->get('sortBy') : 'created_at';
            $blogs = $blogs_private->merge($blogs_public);
            // $blogs = $blog->collapse()->all();
            // dd($blogs);

            return BlogsResource::collection(
                $blogs->paginate($limit)
            );
    }
    /**
     * Return the specified resource.
     *
     * @param Blog blog
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Blog $blog)
    {
        return new BlogsResource($blog);
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

        return new BlogsResource(Blog::orderBy('created_at', 'desc')->first());
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

        return new BlogsResource($blog);
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
    
    /**
     * Shows all blogs of all users tagwise
     */
    public function show_all_blogs_tagwise(Request $request){
      
        $btag = BlogTag::where('name',$request['tag'])->first();
        $id=$request['id']; 
        $limit = $request->get('paginate') ? $request->get('paginate') : 21;
        $orderBy = $request->get('orderBy') ? $request->get('orderBy') : 'DESC';
        $sortBy = $request->get('sortBy') ? $request->get('sortBy') : 'created_at';
        return BlogsResource::collection(
            $btag->blogs()->orderBy($sortBy, $orderBy)->paginate($limit)
        );
}

/**
 * Shows all blogs of my career posts
 */
public function show_my_career_blogs(Request $request){
            $btag = BlogTag::where('name','Careers')->first();
            $id=$request['id'];
         
            $limit = $request->get('paginate') ? $request->get('paginate') : 21;
            $orderBy = $request->get('orderBy') ? $request->get('orderBy') : 'DESC';
            $sortBy = $request->get('sortBy') ? $request->get('sortBy') : 'created_at';
            return BlogsResource::collection(
                $btag->blogs()->where('created_by', $id)->orderBy($sortBy, $orderBy)->paginate($limit)
            );
}


/**
 * Shows all blogs of my  friends career posts
 */
public function show_my_friends_career_blogs(Request $request){
    $btag = BlogTag::where('name','Careers')->first();
    $id=$request['id'];
 
    $limit = $request->get('paginate') ? $request->get('paginate') : 21;
    $orderBy = $request->get('orderBy') ? $request->get('orderBy') : 'DESC';
    $sortBy = $request->get('sortBy') ? $request->get('sortBy') : 'created_at';
    return BlogsResource::collection(
        $btag->blogs()->where('created_by', $id)->orderBy($sortBy, $orderBy)->paginate($limit)
    );
}


}
