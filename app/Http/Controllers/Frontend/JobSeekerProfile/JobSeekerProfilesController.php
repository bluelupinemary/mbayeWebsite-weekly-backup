<?php

namespace App\Http\Controllers\Frontend\JobSeekerProfile;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Access\User\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Responses\RedirectResponse;
use App\Models\JobSeekerProfile\Education;
use App\Models\JobSeekerProfile\Profession;
use App\Models\JobSeekerProfile\WorkExperience;
use App\Models\JobSeekerProfile\JobSeekerProfile;
use App\Models\JobSeekerProfile\CharacterReferences;
use App\Repositories\Frontend\JobSeekerProfile\JobSeekerProfilesRepository;
use Illuminate\Support\Facades\Crypt;
use Hashids\Hashids;

/**
 * Class profileController.
 */
class JobSeekerProfilesController extends Controller
{

    /**
     * @var CarreirProfilesRepository
     */
    protected $profile;

    public function __construct(JobSeekerProfilesRepository $profile)
    {
        $this->profile = $profile;
    }

   
    public function index(Request $request)
    {
     
      $jobId = JobSeekerProfile::where('user_id',Auth::user()->id)->first();
      $user = User::where('id',Auth::user()->id)->first();
      $profession = Profession::all();
      if ($jobId === null) {
      return view('frontend.user.setup_jobseeker_profile',compact('user','profession'));
    }
    else{
        return redirect('jobseekers/edit-setup-profile');
    }
}
    public function edit_profile(Request $request)
    {
       // dd(JobSeekerProfile::find(1)->charref);
      $user = Auth::user();
      $profile = JobSeekerProfile::where('user_id',$user->id)->first();
      $educations = Education::where('jobseeker_profile_id',$profile->id)->get();
    //   dd($education);
      $workExperience = WorkExperience::where('jobseeker_profile_id',$profile->id)->get();
      $characterRefrence = CharacterReferences::where('jobseeker_profile_id',$profile->id)->get();
      $profession = Profession::all();
      return view('frontend.user.edit_jobseeker_profile',compact('user','profession','profile','educations','workExperience','characterRefrence'));
    }

    public function saveJobSeekerProfile(Request $request)
    {
        //dd("ok");
        //dd($request->all());
        $user = User::find($request->user_id);
        $file = $request->file;
        $contents = file_get_contents($file);
        $filename = $user->id.'.png';
        Storage::disk('local')->put('public/career/employee/'.$filename, $contents);

        $check_user_jobseekerprofile = JobSeekerProfile::where('user_id', $user->id)
                              ->first();

        if(!$check_user_jobseekerprofile) {
            $job_seeker_profiles = new JobSeekerProfile();
            $job_seeker_profiles->featured_image = $filename;
            $job_seeker_profiles->profession_id = '1';
            $job_seeker_profiles->user_id = $user->id;
            $job_seeker_profiles->save();
            return response()->json(['msg' => 'Success']);
            return redirect()->back();
        } else {
            $check_user_jobseekerprofile->featured_image = $filename;
            $check_user_jobseekerprofile->save();
            return response()->json(['msg' => 'This will overwrite your featured image']);
            return redirect()->back()->with('alert', 'This will overwrite your featured image');
        }

        return array('filename' => $filename); 
    }

    public function create()
    {
        
    }

  
    public function store()
    {
      
    }

    public function edit()
    {
        
    }

   
    public function update()
    {
        
    }

    public function show($id)
    {
       
    }

    
    public function destroy($id)
    {
        
    }

    /**
     * Function to save details into work experinece 
     */
    public function save_work_experience(Request $request){
        $user_id = Auth::user()->id;        //for each entry in the entries changed array / all the fields modified
        // dd($user_id);
            //delete all existing education entries for the current jobseeker profile
            $jobseeker_profile_id = JobSeekerProfile::where('user_id',$user_id)->first()->id;
            
            $work_experience = WorkExperience::where('jobseeker_profile_id', $jobseeker_profile_id);
            // dd($work_experience);
            if($work_experience) $work_experience->delete();
            
            for($i=0; $i<count($request->start_date); $i++){
                    $start_date = $request['start_date'][$i];
                    // 
                    $end_date = $request['end_date'][$i];
                    
                    $company_name = $request['company_name'][$i];
                    $description = $request['address'][$i];
                    $role = $request['role'][$i];
                    $contact_no = $request['contact_no'][$i];
                    $designation = $request['designation'][$i];
                    $address = $request['address'][$i];
                   
                    //create new entries for each
                    $work_data = new WorkExperience();
                    // dd($work_data);
                    $work_data->start_date = $start_date;
                    
                    $work_data->end_date = $end_date;
                    $work_data->company_name = $company_name; 
                    $work_data->address = $address;
                    $work_data->role = $role; 
                    $work_data->contact_no = $contact_no;
                    $work_data->designation = $designation;
                    $work_data->jobseeker_profile_id = $jobseeker_profile_id;
                    
                    $work_data->save();
            }//end of foreach
           
        }
        /**
     * Function to save details into education
     */
    public function save_education(Request $request){
        $user_id = Auth::user()->id;
        $jobseeker_profile_id = JobSeekerProfile::where('user_id',$user_id)->first()->id;
        $jobseeker_education = Education::where('jobseeker_profile_id', $jobseeker_profile_id);
        if($jobseeker_education) $jobseeker_education->delete();
        
        for($i=0; $i<count($request->education_level); $i++){
                $education_level = $request['education_level'][$i];
                $school_name = $request['school_name'][$i];
                $field_of_study = $request['field_of_study'][$i];
                $description = $request['description'][$i];
                $start_date = $request['start_date'][$i];
                $end_date = $request['end_date'][$i];
              
                //create new entries for each
                $education_data = new Education();
                $education_data->education_level = $education_level;
                $education_data->school_name = $school_name;
                $education_data->field_of_study = $field_of_study; 
                $education_data->description = $description;
                $education_data->start_date = $start_date; 
                $education_data->end_date = $end_date;
                $education_data->jobseeker_profile_id = $jobseeker_profile_id;
                $education_data->save();
        }//end of foreach
   
    }
    /**
     * Function to save character references
     */
    public function save_character_references(Request $request){
        $user_id = Auth::user()->id;        //for each entry in the entries changed array / all the fields modified
        // dd($user_id);
        //delete all existing education entries for the current jobseeker profile
        $jobseeker_profile_id = JobSeekerProfile::where('user_id',$user_id)->first()->id;
        
        $reference = CharacterReferences::where('jobseeker_profile_id', $jobseeker_profile_id);
        // dd($work_experience);
        if($reference) $reference->delete();
        
        for($i=0; $i<count($request->name); $i++){
                $name = $request['name'][$i];
                // 
                $email = $request['email'][$i];
                
                $company_name = $request['company_name'][$i];
                $designation = $request['designation'][$i];
               
               
                //create new entries for each
                $reference_data = new CharacterReferences();
                // dd($reference_data);
                $reference_data->name = $name;
                
                $reference_data->email = $email;
                $reference_data->company_name = $company_name; 
                $reference_data->designation = $designation;
                $reference_data->jobseeker_profile_id = $jobseeker_profile_id;
                
                $reference_data->save();
        }//end of foreach
    }
    
    public function save_contact_details(Request $request){
        $JobSeekerProfile = JobSeekerProfile::where('user_id',Auth::user()->id)->first();
        if($JobSeekerProfile != ''){
            $JobSeekerProfile->update(['secondary_email'=>$request['secondary_email'],'secondary_mobile_number'=>$request['secondary_mobile_number']]);
        }
     
        // $contact = new JobSeekerProfile();
        // $JobSeekerProfile = JobSeekerProfile::find(Auth::user()->id);
        // $secondary_email = $JobSeekerProfile->secondary_email;
        // $secondary_mobile_number = $JobSeekerProfile->secondary_mobile_number;
        // $contact->secondary_email  = $request->secondary_email ;
        // $contact->secondary_mobile_number =  $request->secondary_mobile_number ;
       
        // if($secondary_email=='' ||$secondary_mobile_number=='')
        //         $contact->save();
        // else

        //        $affectedRows = JobSeekerProfile::where('id', '=', Auth::user()->id)->update(array('secondary_email' => $request->secondary_email,'secondary_mobile_number' => $request->secondary_mobile_number));
    }


 
        public function search(Request $request){
        
            if($request->ajax()) {
              
                $data = Profession::where('profession_name', 'LIKE', $request->profession.'%')
                ->orderBy('profession_name', 'asc')     
                ->get();
               
                $output = '';
               
                if (count($data)>0) {
                  
                    $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
                  
                    foreach ($data as $row){
                       
                        $output .= '<li class="list-group-item" >'.$row->profession_name.'</li>';
                    }
                  
                    $output .= '</ul>';
                }
                else {
                 
                    $output .= '<li class="list-group-item">'.'No results'.'</li>';
                }
               
                return $output;
            }
        }
     /**
     * Function to save_professional_details
     */
    public function save_professional_details(Request $request){

           
            $JobSeekerProfile = JobSeekerProfile::where('user_id',Auth::user()->id)->first();
            if($JobSeekerProfile != ''){
                $JobSeekerProfile->update(['profession_id'=>$request['profession_id'],'skills'=>$request['skills']]);
            }
            
        
    }


    /**
     * Function to save aboutme deatils
     */
    public function save_aboutme_details(Request $request){
            // dd($request->all());
            $JobSeekerProfile = JobSeekerProfile::where('user_id',Auth::id())->first();
            if ($JobSeekerProfile == '') {
            $request['user_id'] = Auth::id();

                $save_aboutme_details = $this->profile->create($request->except('_token'));
            }
        else
        {
                $JobSeekerProfile = JobSeekerProfile::where('user_id',Auth::user()->id)->first();
            if($JobSeekerProfile != '')
            {
                $JobSeekerProfile->update(['objective'=>$request['objective'],'present_country'=>$request['present_country'],'state'=>$request['state'],'present_city'=>$request['present_city'],'present_address'=>$request['present_address']]);
            }
        }
       
    }
    public function update_aboutme_details(Request $request, JobSeekerProfile $profile){
        // dd($request->all());
        // $request['user_id'] = Auth::id();
        // $save_aboutme_details = JobSeekerProfile::create($request->except('_token'));
        $JobSeekerProfile = JobSeekerProfile::where('user_id',Auth::user()->id)->first();
        // if(!$JobSeekerProfile){
            $this->profile->update($JobSeekerProfile, $request->except('_token'));
            
            // $JobSeekerProfile->update(['objective'=>$request['objective'],'present_country'=>$request['present_country'],'state'=>$request['state'],'present_city'=>$request['present_city'],'present_address'=>$request['present_address']]);
        // }
    }
     
    public function update_education_details(Request $request){

        // dd($request->all());

        //cases to check: 1 - modify fetched data from db, 2 - modify data and append new, 3 - do not modify and append new, 4 - delete fetched and append new, 5 - modify fetched, delete fetched, append new
   
        $user_id = $request['user_id'];        //for each entry in the entries changed array / all the fields modified
        // dd($user_id);
        //delete all existing education entries for the current jobseeker profile
        $jobseeker_profile_id = JobSeekerProfile::where('user_id',$user_id)->first()->id;
        $jobseeker_education = Education::where('jobseeker_profile_id', $jobseeker_profile_id);
        if($jobseeker_education) $jobseeker_education->delete();
        
        for($i=0; $i<count($request->education_level); $i++){
                $education_level = $request['education_level'][$i];
                $school_name = $request['school_name'][$i];
                $field_of_study = $request['field_of_study'][$i];
                $description = $request['description'][$i];
                $start_date = $request['start_date'][$i];
                $end_date = $request['end_date'][$i];
              
                //create new entries for each
                $education_data = new Education();
                $education_data->education_level = $education_level;
                $education_data->school_name = $school_name;
                $education_data->field_of_study = $field_of_study; 
                $education_data->description = $description;
                $education_data->start_date = $start_date; 
                $education_data->end_date = $end_date;
                $education_data->jobseeker_profile_id = $jobseeker_profile_id;
                $education_data->save();
        }//end of foreach
       
    }
    
    
     
    public function update_workExperience(Request $request){

        // dd($request->all());

        //cases to check: 1 - modify fetched data from db, 2 - modify data and append new, 3 - do not modify and append new, 4 - delete fetched and append new, 5 - modify fetched, delete fetched, append new
   
        $user_id = $request['user_id'];        //for each entry in the entries changed array / all the fields modified
    // dd($user_id);
        //delete all existing education entries for the current jobseeker profile
        $jobseeker_profile_id = JobSeekerProfile::where('user_id',$user_id)->first()->id;
        
        $work_experience = WorkExperience::where('jobseeker_profile_id', $jobseeker_profile_id);
        // dd($work_experience);
        if($work_experience) $work_experience->delete();
        
        for($i=0; $i<count($request->start_date); $i++){
                $start_date = $request['start_date'][$i];
                // 
                $end_date = $request['end_date'][$i];
                
                $company_name = $request['company_name'][$i];
                $description = $request['address'][$i];
                $role = $request['role'][$i];
                $contact_no = $request['contact_no'][$i];
                $designation = $request['designation'][$i];
                $address = $request['address'][$i];
               
                //create new entries for each
                $work_data = new WorkExperience();
                // dd($work_data);
                $work_data->start_date = $start_date;
                
                $work_data->end_date = $end_date;
                $work_data->company_name = $company_name; 
                $work_data->address = $address;
                $work_data->role = $role; 
                $work_data->contact_no = $contact_no;
                $work_data->designation = $designation;
                $work_data->jobseeker_profile_id = $jobseeker_profile_id;
                
                $work_data->save();
        }//end of foreach
       
    }    
    
    
    public function update_character_reference(Request $request){

        // dd($request->all());

        //cases to check: 1 - modify fetched data from db, 2 - modify data and append new, 3 - do not modify and append new, 4 - delete fetched and append new, 5 - modify fetched, delete fetched, append new
   
        $user_id = $request['user_id'];        //for each entry in the entries changed array / all the fields modified
        // dd($user_id);
        //delete all existing education entries for the current jobseeker profile
        $jobseeker_profile_id = JobSeekerProfile::where('user_id',$user_id)->first()->id;
        
        $reference = CharacterReferences::where('jobseeker_profile_id', $jobseeker_profile_id);
        // dd($work_experience);
        if($reference) $reference->delete();
        
        for($i=0; $i<count($request->name); $i++){
                $name = $request['name'][$i];
                // 
                $email = $request['email'][$i];
                
                $company_name = $request['company_name'][$i];
                $designation = $request['designation'][$i];
               
               
                //create new entries for each
                $reference_data = new CharacterReferences();
                // dd($reference_data);
                $reference_data->name = $name;
                
                $reference_data->email = $email;
                $reference_data->company_name = $company_name; 
                $reference_data->designation = $designation;
                $reference_data->jobseeker_profile_id = $jobseeker_profile_id;
                
                $reference_data->save();
        }//end of foreach
       
    } 

    
    public function show_my_profile($id)
    {
        
        $user = Auth::user();
        $profession = Profession::all();
        $profile = JobSeekerProfile::where('user_id',$id)->first();
        // dd($profile);
        return  view('frontend.blog.blogview.career.my_career_profile',compact('user','profession','profile'));
    }


}