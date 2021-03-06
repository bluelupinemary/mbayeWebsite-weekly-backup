<?php

namespace App\Http\Controllers\Backend\Blogs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Blogs\ManageBlogsRequest;
use App\Models\BlogShares\BlogShare;
use App\Repositories\Backend\Blogs\BlogsRepository;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class BlogsTableController.
 */
class DeletedBlogsTableController extends Controller
{
    protected $blogs;

    /**
     * @param \App\Repositories\Backend\Blogs\BlogsRepository $cmspages
     */
    public function __construct(BlogsRepository $blogs)
    {
        $this->blogs = $blogs;
    }

    /**
     * @param \App\Http\Requests\Backend\Blogs\ManageBlogsRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageBlogsRequest $request)
    {
        return Datatables::of($this->blogs->getdeletedblog())
            ->escapeColumns(['name'])
            ->addColumn('status', function ($blogs) {
                return $blogs->status;
            })
            ->addColumn('publish_datetime', function ($blogs) {
                return $blogs->publish_datetime->format('d/m/Y h:i A');
            })
            ->addColumn('tags', function ($blogs) {
                return $blogs->tags;
            })
            ->addColumn('created_by', function ($blogs) {
                return $blogs->first_name. ' '.$blogs->last_name;
            })
            ->addColumn('shares', function ($blogs) {
                return BlogShare::where('blog_id',$blogs->id)->count();
            })
            ->addColumn('privacy', function ($blogs) {
                $p = $blogs->getgroups();
                if($p == null){
                    return "No Privacy";
                }else{
                    return $p;
                }  
            })
            ->addColumn('Email', function ($blogs) {
                return $blogs->email;
            })
            ->addColumn('created_at', function ($blogs) {
                return $blogs->created_at->toDateString();
            })
            ->addColumn('actions', function ($blogs) {
                return $blogs->trashed_buttons;
            })
            ->make(true);
    }
}
