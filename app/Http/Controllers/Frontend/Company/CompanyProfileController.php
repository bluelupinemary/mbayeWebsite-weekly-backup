<?php

namespace App\Http\Controllers\Frontend\Company;

use App\Http\Controllers\Controller;
use App\Models\Company\CompanyProfile;
use App\Models\Company\Industry;
use App\Models\Access\User\User;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\CompanyProfile\StoreCompanyProfileRequest;
use App\Repositories\Frontend\CompanyProfile\CompanyProfilesRepository;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Auth;

class CompanyProfileController extends Controller
{
    /**
     * @var CompanyProfilesRepository
     */
    protected $company_profile;

    /**
     * @param \App\Repositories\Backend\Blogs\BlogsRepository $blog
     */
    public function __construct(CompanyProfilesRepository $company_profile)
    {
        $this->company_profile = $company_profile;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyProfileRequest $request)
    {
        // dd($request);
        
        $request->owner_id = Auth::user()->id;
        // dd($request);
        
        
        $saved_company_profile = $this->company_profile->create($request->except('_token'));
        

        $user = User::find($request->owner_id);

        if($user->roles[0]->name == 'User') {
            return redirect('career/companyProfile')->with('status', 'Profile updated!');
            // return array('status' => 'success', 'message' => 'Company profile saved!', 'data' => $saved_company_profile);
        } else {
            // return new RedirectResponse(route('admin.blogs.index'), ['flash_success' => trans('alerts.backend.blogs.created')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company_profile = CompanyProfile::find($id);

        return $company_profile;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCompanyProfileRequest $request, $id)
    {
        $company_profile = CompanyProfile::find($id);
        $saved_company_profile = $this->company_profile->update($company_profile, $request->except('_token'));

        $user = User::find($request->owner_id);

        if($user->roles[0]->name == 'User') {
            return array('status' => 'success', 'message' => 'Company profile updated!', 'data' => $saved_company_profile);
        } else {
            // return new RedirectResponse(route('admin.blogs.index'), ['flash_success' => trans('alerts.backend.blogs.created')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company_profile = CompanyProfile::find($id)->delete();

        return array('status' => 'success', 'message' => 'Company Profile deleted successfully!');
    }
}
