<?php

namespace App\Http\Controllers\Api\V1;

use Validator;
use App\Models\Blogs\Blog;
use App\Models\BlogTags\BlogTag;
use App\Repositories\Backend\Blogs\BlogsRepository;
use Illuminate\Http\Request;
use App\Http\Resources\BlogsResource;

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
    public function showbytag(Request $request)
    {
        $btag = BlogTag::where('name',$request['blogtag'])->first();
    //  dd($btag);
        $limit = $request->get('paginate') ? $request->get('paginate') : 21;
        $orderBy = $request->get('orderBy') ? $request->get('orderBy') : 'DESC';
        $sortBy = $request->get('sortBy') ? $request->get('sortBy') : 'created_at';
        return BlogsResource::collection(
            $btag->blogs()->orderBy($sortBy, $orderBy)->paginate($limit)
        );
    }
    public function showbytagforfriend(Request $request){
 
            $btag = BlogTag::where('name',$request['tag'])->first();
            // dd( $btag->name);
            $id=$request['id'];
            $limit = $request->get('paginate') ? $request->get('paginate') : 21;
            $orderBy = $request->get('orderBy') ? $request->get('orderBy') : 'DESC';
            $sortBy = $request->get('sortBy') ? $request->get('sortBy') : 'created_at';
            return BlogsResource::collection(
                $btag->blogs()->where('created_by', $id)->orderBy($sortBy, $orderBy)->paginate($limit)
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
}
