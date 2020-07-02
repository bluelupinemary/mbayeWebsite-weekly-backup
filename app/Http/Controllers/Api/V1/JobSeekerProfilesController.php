<?php

namespace App\Http\Controllers\Api\V1;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
     
        $search=$request['search'];
        $type=$request['type'];
        $limit = $request->get('paginate') ? $request->get('paginate') : 21;
        $orderBy = $request->get('orderBy') ? $request->get('orderBy') : 'DESC';
        $sortBy = $request->get('sortBy') ? $request->get('sortBy') : 'job_seeker_profiles.created_at';

        if($search!='' ||  $type!=''){
				$job = DB::table('users')
                ->join('job_seeker_profiles', 'users.id', '=', 'job_seeker_profiles.user_id')
                ->join('professions', 'professions.id', '=', 'job_seeker_profiles.profession_id')
                ->select('job_seeker_profiles.*', 'users.*', 'professions.*')
                ->when($search, function ($query, $search) {
                        return $query->where(function ($q) use ($search) {
                            $q->where('job_seeker_profiles.skills', 'like', '%'.$search.'%')
                            ->orWhere('profession_name', 'like', '%'.$search.'%')
                            ->orWhere('country', 'like', '%'.$search.'%');
                           
                     });
                    })
                ->orderBy( $sortBy, $orderBy)
                ->limit($limit)
                ->get();
            
              foreach($job as $key=>$value){
                $job[$key]->thumb='/storage/img/JobSeekerProfile/'. $job[$key]->featured_image;
              }
                      
                $arrResult=array('data'=>$job);
                return  response()->json($arrResult);
               
       }
       else{
        return JobSeekerProfileResource::collection(
            $this->repository->getForDataTable()->orderBy($sortBy, $orderBy)->paginate($limit)
        );

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
