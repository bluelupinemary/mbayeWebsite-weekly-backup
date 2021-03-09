<?php

namespace App\Http\Controllers\Backend\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CompanyProfile\ManageCompanyRequest;
use App\Repositories\Backend\Company\CompanyRepository;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class BlogsTableController.
 */
class CompanyTableController extends Controller
{
    protected $companyprofile;

    /**
     * @param \App\Repositories\Backend\CompanyProfile\ManageCompanyRequest $cmspages
     */
    public function __construct(CompanyRepository $companyprofile)
    {
        $this->companyprofile = $companyprofile;
    }

    /**
     * @param \App\Http\Requests\Backend\CompanyProfile\ManageCompanyRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageCompanyRequest $request)
    {
        return Datatables::of($this->companyprofile->getForDataTable($request->get('trashed')))
            ->addColumn('company_Owner', function ($companyprofile) {
                return '<a href="access/user/'.$companyprofile->user->id.'">'. $companyprofile->user->first_name.' '. $companyprofile->user->last_name .'</a>';
                // return '<a href="{{route(\'admin.access.user.show,$companyprofile->user->id\')}}">'. $companyprofile->user->first_name.' '. $companyprofile->user->last_name .'</a>';
            })
            ->addColumn('Industry_name', function ($companyprofile) {
                return $companyprofile->industry->industry_name;
            })
            ->addColumn('actions', function ($companyprofile) {
                return $companyprofile->action_buttons;
            })
            ->rawColumns(['actions' => 'actions','company_Owner' => 'company_Owner'])
            ->make(true);
    }
}
