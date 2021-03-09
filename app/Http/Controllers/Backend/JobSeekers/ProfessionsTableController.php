<?php

namespace App\Http\Controllers\Backend\JobSeekers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Professions\ManageProfessionRequest;
use App\Repositories\Backend\Career\ProfessionRepository;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class BlogTagsTableController.
 */
class ProfessionsTableController extends Controller
{
    /**
     * @var \App\Repositories\Backend\Career\ProfessionRepository
     */
    protected $professions;

    /**
     * @param \App\Repositories\Backend\Career\ProfessionRepository $profession
     */
    public function __construct(ProfessionRepository $professions)
    {
        $this->professions = $professions;
    }

    /**
     * @param \App\Http\Requests\Backend\Professions\ManageProfessionRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageProfessionRequest $request)
    {
        return Datatables::of($this->professions->getForDataTable())
            ->escapeColumns(['profession_name'])
            ->addColumn('created_at', function ($professions) {
                return Carbon::parse($professions->created_at)->toDateString();
            })
            ->addColumn('actions', function ($professions) {
                return $professions->action_buttons;
            })
            ->make(true);
    }
}
