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
     
        $limit = $request->get('paginate') ? $request->get('paginate') : 21;
        $orderBy = $request->get('orderBy') ? $request->get('orderBy') : 'DESC';
        $sortBy = $request->get('sortBy') ? $request->get('sortBy') : 'job_seeker_profiles.created_at';
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
       if($search=='' && $type=='Career Profile' ){
                     $sortBy = $request->get('sortBy') ? $request->get('sortBy') : 'job_seeker_profiles.created_at';
                        return JobSeekerProfileResource::collection(
                            $this->repository->getForDataTable()->orderBy($sortBy, $orderBy)->paginate($limit)
                        );
            
                    }
            
        if($search=='' && $type=='' ){
            $sortBy = $request->get('sortBy') ? $request->get('sortBy') : 'job_seeker_profiles.created_at';
                return JobSeekerProfileResource::collection(
                    $this->repository->getForDataTable()->orderBy($sortBy, $orderBy)->paginate($limit)
                );

            }



        // return response()->json(array('search'=>$search,'type'=>$type,'country'=>$country));
//         $search=$request['search'];
//         $type=$request['type'];
//         $country=$request['country']; 
//         if($country=='')
//             $country=$search;
//         $limit = $request->get('paginate') ? $request->get('paginate') : 21;
//         $orderBy = $request->get('orderBy') ? $request->get('orderBy') : 'DESC';
//         $sortBy = $request->get('sortBy') ? $request->get('sortBy') : 'job_seeker_profiles.created_at';

//         if($search!='' && ( $type!='' &&  $type=='Career Profile')){
// 				$job = DB::table('users')
//                 ->join('job_seeker_profiles', 'users.id', '=', 'job_seeker_profiles.user_id')
//                 ->join('professions', 'professions.id', '=', 'job_seeker_profiles.profession_id')
//                 ->select('job_seeker_profiles.*', 'users.*', 'professions.*')
//                 ->when($search, function ($query, $search) {
//                         return $query->where(function ($q) use ($search) {
//                             $q->where('job_seeker_profiles.skills', 'like', '%'.$search.'%')
//                             ->orWhere('profession_name', 'like', '%'.$search.'%')
//                             ->orWhere('country', 'like', '%'.$search.'%');
                           
//                      });
//                     })
//                 ->orderBy( $sortBy, $orderBy)
//                 ->limit($limit)
//                 ->get();
            
//               foreach($job as $key=>$value){
//                 $job[$key]->thumb='/storage/img/JobSeekerProfile/'. $job[$key]->featured_image;
//               }
                      
//                 $arrResult=array('data'=>$job);
//                 return  response()->json($arrResult);
               
//        }
//        else  if($search!='' && ( $type!='' &&  $type=='Companies')){  
//             $sortBy = $request->get('sortBy') ? $request->get('sortBy') : 'company_profiles.created_at';
//                     $job = DB::table('users')
//                     ->join('company_profiles', 'users.id', '=', 'company_profiles.owner_id')
//                     ->select('company_profiles.*', 'users.*')
//                     ->when($search, function ($query, $search) {
//                             return $query->where(function ($q) use ($search) {
//                                 $q->where('company_profiles.company_name', 'like', '%'.$search.'%')
//                                 ->orWhere('country', 'like', '%'.$search.'%');
//                         });
//                         })
//                     ->orderBy( $sortBy, $orderBy)
//                     ->limit($limit)
//                     // ->toSql();
//                     // echo  $job;    
//                     ->get();
                
//                 foreach($job as $key=>$value){
//                     $job[$key]->thumb='/storage/img/ComapnyProfile/'. $job[$key]->featured_image;
//                 }
                    
//                     $arrResult=array('data'=>$job);
//                     return  response()->json($arrResult);
               
//             }
//        else if($search=='' && $type=='Career Profile' ){
//             return JobSeekerProfileResource::collection(
//                 $this->repository->getForDataTable()->orderBy($sortBy, $orderBy)->paginate($limit)
//             );

//         }

//        else if($search=='' && $type=='Companies' ){ 
      
//         $sortBy = $request->get('sortBy') ? $request->get('sortBy') : 'company_profiles.created_at';
//         if($country!='' ){
//             $job = DB::table('users')
//             ->join('company_profiles', 'users.id', '=', 'company_profiles.owner_id')
//             ->join('industries', 'industries.id', '=', 'company_profiles.industry_id')
//             ->select('company_profiles.*', 'users.*', 'industries.*')
//             ->when($country, function ($query, $country) {
//                     return $query->where(function ($q) use ($country) {
//                         $q->where('country', 'like', '%'.$country.'%');
//                 });
//                 })
//             ->orderBy( $sortBy, $orderBy)
//             ->limit($limit)
//             ->get();

// }
// else{
     
//     $job = DB::table('users')
//     ->join('company_profiles', 'users.id', '=', 'company_profiles.owner_id')
//     ->join('industries', 'industries.id', '=', 'company_profiles.industry_id')
//     ->select('company_profiles.*', 'users.*', 'industries.*')
//     ->when($search, function ($query, $search) {
//             return $query->where(function ($q) use ($search) {
//                 $q->where('company_profiles.company_name', 'like', '%'.$search.'%')
//                 ->orWhere('country', 'like', '%'.$search.'%');
            
//         });
//         })
//     ->orderBy( $sortBy, $orderBy)
//     ->limit($limit)
//     ->get();
// }

          
//                 foreach($job as $key=>$value){
//                     $job[$key]->thumb='/storage/img/ComapnyProfile/'. $job[$key]->featured_image;
//                 }
                
//                     $arrResult=array('data'=>$job);
//                     return  response()->json($arrResult);
//        }
//       else if($search=='' && $type=='' ){
//         return JobSeekerProfileResource::collection(
//             $this->repository->getForDataTable()->orderBy($sortBy, $orderBy)->paginate($limit)
//         );

//     }
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
