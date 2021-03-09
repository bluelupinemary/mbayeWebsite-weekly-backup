<?php

namespace App\Http\Controllers\Backend\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Industries\ManageIndustryRequest;
use App\Repositories\Backend\Company\IndustryRepository;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class IndustriesTableController.
 */
class IndustriesTableController extends Controller
{
    /**
     * @var \App\Repositories\Backend\company\IndustryRepository
     */
    protected $industries;

    /**
     * @param \App\Repositories\Backend\Company\IndustryRepository $industry
     */
    public function __construct(IndustryRepository $industries)
    {
        $this->industries = $industries;
    }

    /**
     * @param \App\Http\Requests\Backend\Industries\ManageIndustryRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageIndustryRequest $request)
    {
        return Datatables::of($this->industries->getForDataTable())
            ->escapeColumns(['industry_name'])
            ->addColumn('created_at', function ($industries) {
                return Carbon::parse($industries->created_at)->toDateString();
            })
            ->addColumn('actions', function ($industries) {
                return $industries->action_buttons;
            })
            ->make(true);
    }
}
