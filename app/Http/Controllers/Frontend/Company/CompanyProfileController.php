<?php

namespace App\Http\Controllers\Frontend\Company;

use Auth;
use Illuminate\Http\Request;
use App\Models\Access\User\User;
use App\Http\Controllers\Controller;
use App\Models\Company\CompanyProfile;
use App\Models\CompanyProfile\Industry;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Requests\Backend\CompanyProfile\StoreCompanyRequest;
use App\Repositories\Frontend\CompanyProfile\CompanyProfilesRepository;
// use App\Http\Requests\Backend\CompanyProfile\StoreCompanyProfileRequest;
use App\Http\Requests\Backend\CompanyProfile\UpdateCompanyProfileRequest;


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
    public function index(Request $request)
    {
        // dd(JobSeekerProfile::find(1)->charref);
        //   $user = Auth::user();
        $user = CompanyProfile::where('owner_id',Auth::user()->id)->first();
        //   dd($user);
        $industry = Industry::all();
        if ($user === null) {
            return view('frontend.user.setup_company_profile',compact('user','industry'));
            //
        }
        else{
            return redirect('company/setup-profile/'.Auth::user()->id)->with('status', 'Profile updated!');
        }
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
    public function store(StoreCompanyRequest $request)
    {
        
        
        $request->owner_id = Auth::user()->id;
        // dd($request);
        
        
        $saved_company_profile = $this->company_profile->create($request->except('_token'));
        

        $user = User::find($request->owner_id);
        return redirect('company/view-company-profile/'.Auth::user()->id)->with('status', 'Profile updated!');
        // if($user->roles[0]->name == 'User') {
        //     dd('PPPP');
        //     return redirect('communicator')->with('status', 'Profile updated!');
        //     // return array('status' => 'success', 'message' => 'Company profile saved!', 'data' => $saved_company_profile);
        // } else {
        //     // return new RedirectResponse(route('admin.blogs.index'), ['flash_success' => trans('alerts.backend.blogs.created')]);
        // }
    }

    /**
     * Display the specified resource.
     *
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user()->id;
        $industry = Industry::all();
        $company = CompanyProfile::where('owner_id',$id)->first();
      
            return  view('frontend.user.view_company_profile',compact('industry','company','user'));
      
        // dd($company);
        
        // $company_profile = CompanyProfile::find($id);

        // return $company_profile;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        $company_profile = CompanyProfile::where('owner_id',$id)->first();
        $industry = Industry::all();
        // dd(compact('company_profile','industry'));
        //
        return view('frontend.user.setup_company_profile',compact('company_profile','industry'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyProfileRequest $request,CompanyProfile $company_profile)
    {
        // dd($request->all());
        // dd($company_profile);
        // $company_profile = CompanyProfile::where('owner_id',Auth::user()->id)->first();
        // if($company_profile != ''){
        //     // $company_profile->update(['company_name'=>$request['company_name'],'company_email'=>$request['company_email'],'company_phone_number'=>$request['company_phone_number'],'featured_image'=>$request['featured_image'],'industry_id'=>$request['industry_id'],'state'=>$request['state'],'city'=>$request['city'],'address'=>$request['address'],'country'=>$request['country']]);
        //     $company_profile->update($request->all());
        
        // }
        $company_profile = CompanyProfile::where('owner_id',Auth::user()->id)->first();
        // dd($company_profile);
        $saved_company_profile = $this->company_profile->update($company_profile, $request->except('_token'));
        // // dd($saved_company_profile);
        // $user = User::find($request->owner_id);

        // if($user->roles[0]->name == 'User') {
            return redirect('company/view-company-profile/'.Auth::user()->id)->with('status', 'Profile updated!');
        // } else {
        //     // return new RedirectResponse(route('admin.blogs.index'), ['flash_success' => trans('alerts.backend.blogs.created')]);
        // }
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

    public function validateEmail(Request $request)
    {
        $company = CompanyProfile::where('company_email', $request->company_email)->first();
        // dd($company);
        if ($company) 
        {
            return response()->json([
                    'status' => 'exist',
                    'message' => 'email is already in database'
                ], 200); 
        }
        if($company==null)
        {
            return response()->json([
                    'status' => 'not-exist',
                    'message' => 'email is not present in database'
                ], 200);   
        }
    }
}
