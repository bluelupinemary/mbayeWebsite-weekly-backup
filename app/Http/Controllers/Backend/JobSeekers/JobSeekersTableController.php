<?php

namespace App\Http\Controllers\Backend\JobSeekers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\JobSeekers\ManageJobSeekersRequest;
use App\Repositories\Backend\Career\JobSeekerRepository;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class BlogsTableController.
 */
class JobSeekersTableController extends Controller
{
    protected $jobseekers;

    /**
     * @param \App\Repositories\Backend\Blogs\JobSeekerRepository $cmspages
     */
    public function __construct(JobSeekerRepository $jobseekers)
    {
        $this->jobseekers = $jobseekers;
    }

    /**
     * @param \App\Http\Requests\Backend\Blogs\ManageBlogsRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageJobSeekersRequest $request)
    {
        return Datatables::of($this->jobseekers->getForDataTable($request->get('trashed')))
            // ->escapeColumns(['secondary_email'])
            // ->addColumn('status', function ($blogs) {
            //     return $blogs->status;
            // })
            // ->addColumn('publish_datetime', function ($blogs) {
            //     return $blogs->publish_datetime->format('d/m/Y h:i A');
            // })
            // ->addColumn('tag_name', function ($blogs) {
            //     // return $blogs->tags->pluck('name')->toArray();
            //     return $blogs->tags->map(function($tags) {
            //         return $tags->name;
            //     })->implode(',');
            // })
            // ->addColumn('created_by', function ($blogs) {
            //     return $blogs->owner->first_name. ' '.$blogs->owner->last_name;
            // })
            // ->addColumn('shares', function ($blogs) {
            //     return BlogShare::where('blog_id',$blogs->id)->where('blog_type','App\Models\Blogs\Blog')->count();
            // })
            // ->addColumn('privacy', function ($blogs) {
            //     $p = $blogs->getgroups();
            //     if($p == null){
            //         return "No Privacy";
            //     }else{
            //         return $p;
            //     }  
            // })
            // ->addColumn('email', function ($blogs) {
            //     return $blogs->owner->email;
            // })
            // ->addColumn('created_at', function ($blogs) {
            //     return $blogs->created_at->toDateString();
            // })
            ->addColumn('actions', function ($jobseekers) {
                return $jobseekers->action_buttons;
            })
            ->rawColumns(['actions' => 'actions'])
            ->make(true);
    }
}
