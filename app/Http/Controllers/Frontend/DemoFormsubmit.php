<?php

namespace App\Http\Controllers\Frontend;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Company\DemoCompany;
use App\Http\Controllers\Controller;
use App\Models\JobSeekerProfile\Profession;
use App\Repositories\Frontend\CompanyProfile\CompanyProfilesRepository;

class DemoFormsubmit extends Controller
{
    protected $upload;
    public function __construct(CompanyProfilesRepository $upload)
    {
        $this->upload = $upload;
    }
    public function demoSave(Request $request)
    {
        $professions = Profession::all();
        $professions->toArray();
        return $professions;

        
    }

    public function demoSaveIndustry(Request $request)
    {
        $industry = Industry::all();
        $industry->toArray();
        return $industry;

        
    }

}
