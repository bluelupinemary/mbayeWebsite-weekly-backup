<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Company\DemoCompany;
use App\Repositories\Frontend\CompanyProfile\CompanyProfilesRepository;
use Auth;

class DemoFormsubmit extends Controller
{
    protected $upload;
    public function __construct(CompanyProfilesRepository $upload)
    {
        $this->upload = $upload;
    }
    public function demoSave(Request $request)
    {
        
        $request->owner_id = Auth::user()->id;
        $data = $this->upload->create($request->except('_token'));
        // dd($request->all());
        // DB::table('company_profiles')->insert($request->except('_token'));
        //  $company= new DemoCompany;
        //  $company->company_name=$request->company_name;
        //  $company->company_email=$request->company_email;
        //  $company->company_phone_number=$request->company_phone_number;
        //  $company->featured_image=$request->featured_image;
        //  $company->industry_id=$request->industry_id;
        //  $company->owner_id=$request->owner_id;
        //  $company->state=$request->state;
        //  $company->city=$request->city;
        //  $company->address=$request->address;
        //  $company->country=$request->country;
        //  $company->save();

        
    }

}
