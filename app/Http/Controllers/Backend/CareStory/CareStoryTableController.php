<?php

namespace App\Http\Controllers\Backend\CareStory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CareStories\ManageCareStoriesRequest;
use App\Repositories\Backend\CareStory\CareStoryRepository;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class CareStoryTableController.
 */
class CareStoryTableController extends Controller
{
    /**
     * @var \App\Repositories\Backend\CareStories\ManageCareStoriesRequest
     */
    protected $carestory;

    /**
     * @param \App\Repositories\Backend\BlogTags\BlogTagsRepository $carestory
     */
    public function __construct(CareStoryRepository $carestory)
    {
        $this->carestory = $carestory;
    }

    /**
     * @param \App\Http\Requests\Backend\BlogTags\ManageBlogTagsRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageCareStoriesRequest $request)
    {
        return Datatables::of($this->carestory->getForDataTable())
        ->escapeColumns(['name'])
        ->addColumn('status', function ($carestory) {
            return $carestory->status;
        })
        ->addColumn('publish_datetime', function ($carestory) {
            return $carestory->publish_datetime->format('d/m/Y h:i A');
        })
        ->addColumn('created_by', function ($carestory) {
            return $carestory->owner->first_name. ' '.$carestory->owner->last_name;
        })
        ->addColumn('email', function ($carestory) {
            return $carestory->owner->email;
        })
        ->addColumn('created_at', function ($carestory) {
            return $carestory->created_at->toDateString();
        })
        ->addColumn('actions', function ($carestory) {
            return $carestory->action_buttons;
        })
        ->make(true);
    }
}
