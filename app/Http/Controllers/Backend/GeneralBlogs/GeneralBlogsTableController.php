<?php

namespace App\Http\Controllers\Backend\GeneralBlogs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\GeneralBlogs\ManageGeneralBlogsRequest;
use App\Models\BlogShares\BlogShare;
use App\Repositories\Backend\GeneralBlogs\GeneralBlogsRepository;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class BlogsTableController.
 */
class GeneralBlogsTableController extends Controller
{
    protected $blogs;

    /**
     * @param \App\Repositories\Backend\Blogs\BlogsRepository $cmspages
     */
    public function __construct(GeneralBlogsRepository $blogs)
    {
        $this->blogs = $blogs;
    }

    /**
     * @param \App\Http\Requests\Backend\Blogs\ManageBlogsRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageGeneralBlogsRequest $request)
    {
        return Datatables::of($this->blogs->getForDataTable())
            ->escapeColumns(['name'])
            ->addColumn('status', function ($blogs) {
                return $blogs->status;
            })
            ->addColumn('publish_datetime', function ($blogs) {
                return $blogs->publish_datetime->format('d/m/Y h:i A');
            })
            ->addColumn('created_by', function ($blogs) {
                return $blogs->first_name. ' '.$blogs->last_name;
            })
            ->addColumn('shares', function ($blogs) {
                return BlogShare::where('blog_id',$blogs->id)->count();
            })
            ->addColumn('Email', function ($blogs) {
                return $blogs->email;
            })
            ->addColumn('created_at', function ($blogs) {
                return $blogs->created_at->toDateString();
            })
            ->addColumn('privacy', function ($blogs) {
                $p = $blogs->getgroups();
                if($p == null){
                    return "No Privacy";
                }else{
                    return $p;
                }
            })
            ->addColumn('actions', function ($blogs) {
                return $blogs->action_buttons;
            })
            ->make(true);
    }
}
