<?php

namespace App\Http\Controllers\Api\V1;

use Validator;
use Illuminate\Http\Request;
use App\Models\Access\User\User;
use Illuminate\Support\Facades\DB;
use App\Models\CompanyProfile\Industry;
use App\Models\JobSeekerProfile\Profession;
use App\Models\CompanyProfile\CompanyProfile;
use App\Http\Resources\CompanyProfileResource;
use App\Http\Resources\JobSeekerProfileResource;
use App\Models\JobSeekerProfile\JobSeekerProfile;
use App\Repositories\Frontend\JobSeekerProfile\JobSeekerProfilesRepository;


class JobSeekerProfilesController extends APIController
{
    protected $repository;

    /**
     * __construct.
     *
     * @param $repository
     */
    public function __construct(JobSeekerProfilesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Return the blogs.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
     
        $limit = $request->get('paginate') ? $request->get('paginate') : 25;
        $orderBy = $request->get('orderBy') ? $request->get('orderBy') : 'DESC';
        $sortBy = $request->get('sortBy') ? $request->get('sortBy') : 'job_seeker_profiles.created_at';
        $search=$request['search'];
        $type=$request['type'];
        $country=$request['country'];
        $city=$request['city'];

        //search for companies 
        if($type!='' &&  $type=='Companies'){
            $company = CompanyProfile::when($search, function ($query, $search) {
                    $query->where('company_name','LIKE','%'.$search.'%');
                })
                ->when($country, function ($query, $country) {
                    $query->where('country','LIKE','%'.$country.'%');
                })
                ->when($city, function($query, $city) {
                    $query->where('address', 'LIKE', '%'.$city.'%');
                })
                ->with('industry')
                ->paginate($limit);

            return response()->json($company);
        }

        //search for career profiles
        if($type!='' &&  $type=='Profile'){
            $profession = DB::table('professions')
                ->join('job_seeker_profiles','professions.id','=','job_seeker_profiles.profession_id')
                ->join('users','users.id','=','job_seeker_profiles.user_id')
                ->when($search, function ($query, $search) {
                    $query->where('profession_name', 'like' , '%'. $search .'%');
                })
                ->when($country, function ($query, $country) {
                    $query->orWhere('present_country', 'like' , '%'. $country .'%');
                    // ->orWhere('country', 'like' , '%'. $country .'%')
                })
                ->when($city, function ($query, $city) {
                    $query->where('present_city', 'like' , '%'. $city .'%');
                })
                ->select('professions.*','job_seeker_profiles.*','users.*')
                ->paginate($limit);

            return response()->json($profession);
        }
    }
    /**
     * Return the specified resource.
     *
     * @param JobSeekerProfile JobSeekerProfile
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(JobSeekerProfile $generalblog)
    {
        return new JobSeekerProfileResource($generalblog);
    }

    public function getres(Request $request){
        $search=$request['search'];
        $type=$request['type'];
        $country=$request['country'];
        //fetch all companies with respect to country
        if($search=='' && ( $type!='' &&  $type=='Companies')){
            if($country != ''){
                $company = CompanyProfile::where('country','LIKE','%'.$country.'%')->get();
            }
            else{
            $company = CompanyProfile::all();
            }

           
            foreach($company as $key=>$value){
                $company[$key]->thumb='/storage/img/CompanyProfile/'. $company[$key]->featured_image;
              }
            return response()->json(array('data'=>$company));
        
        }
        //search for companies 

        if($search!='' && ( $type!='' &&  $type=='Companies')){
            if($country != ''){
                $company = CompanyProfile::where('company_name','LIKE','%'.$search.'%')->
                where('country','LIKE','%'.$country.'%')->get();
            }
            else{
            $company = CompanyProfile::where('company_name','LIKE','%'.$search.'%')->get();
            }
            // foreach($company as $key=>$value){
            //     $company[$key]->thumb='/storage/img/CompanyProfile/'. $company[$key]->featured_image;
            //   }
            return response()->json(array('company'=>$company));
        
        }
        //search for careerr profiles
        if($search!='' && ( $type!='' &&  $type=='Career Profile')){
            if($country != ''){
                $profession = DB::table('professions')
                ->join('job_seeker_profiles','professions.id','=','job_seeker_profiles.profession_id')
                ->join('users','users.id','=','job_seeker_profiles.user_id')
                ->where('profession_name', 'like' , '%'. $search .'%')
                ->where(function($query) use ($country) {
                    $query->orWhere('country', 'like' , '%'. $country .'%')
                    ->orWhere('present_country', 'like' , '%'. $country .'%');
                })
                ->select('professions.*','job_seeker_profiles.*','users.*')
                ->paginate(25);
            }
            else{
                $profession = DB::table('professions')
                ->join('job_seeker_profiles','professions.id','=','job_seeker_profiles.profession_id')
                ->join('users','users.id','=','job_seeker_profiles.user_id')
                ->where('profession_name', 'like' , '%'. $search .'%')
                ->select('professions.*','job_seeker_profiles.secondary_email','users.username')
                ->paginate(20);
            }
            // foreach($profession as $key=>$value){
            //     $profession[$key]->thumb='/storage/img/JobSeekerProfile/'. $profession[$key]->featured_image;
            //   }
            return response()->json(array('profession'=>$profession));
        
        }
        // return response()->json(array('search'=>$search,'type'=>$type,'country'=>$country));
    }



    /**
     * validate message for validate blog.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function messages()
    {
        return [
            'name.required' => 'Please insert Blog Title',
            'name.max'      => 'Blog Title may not be greater than 191 characters.',
        ];
    }
}
