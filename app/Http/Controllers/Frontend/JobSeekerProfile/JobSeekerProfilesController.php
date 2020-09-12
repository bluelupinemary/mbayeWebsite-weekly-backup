<?php

namespace App\Http\Controllers\Frontend\JobSeekerProfile;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Access\User\User;
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
       // dd(JobSeekerProfile::find(1)->charref);
      $user = Auth::user();
      return view('frontend.user.setup-profile',compact('user'));
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
    //  dd(count($request->start_date));
    // dd($request);
       
            $JobSeekerProfile = JobSeekerProfile::find(Auth::user()->id);
            $id = $JobSeekerProfile->id;
          

            for($counter = 0; $counter < count($request->start_date); $counter++){
                $work_experience = new WorkExperience();
                $work_experience->designation = $request->designation[$counter];
                $work_experience->company_name = $request->company_name[$counter];
                $work_experience->address = $request->address[$counter];
                $work_experience->role = $request->role[$counter];
                $work_experience->contact_no = $request->contact_no[$counter];
                $work_experience->start_date = $request->start_date[$counter];
                $work_experience->end_date = $request->end_date[$counter];
                $work_experience->jobseeker_profile_id = $id;
                $work_experience->created_at = date('Y-m-d H:i:s');
                $work_experience->save();
               
            }

          
            
           
        }
        /**
     * Function to save details into education
     */
    public function save_education(Request $request){
   
        $JobSeekerProfile = JobSeekerProfile::find(Auth::user()->id);
        $id = $JobSeekerProfile->id;
        for($counter = 0; $counter < count($request->start_date); $counter++){
            $education = new Education();
            $education->school_name = $request->school_name[$counter];
            $education->field_of_study = $request->field_of_study[$counter];
            $education->start_date = $request->start_date[$counter];
            $education->end_date = $request->end_date[$counter];
            $education->description = $request->description[$counter];
            $education->education_level = $request->education_level[$counter];
            $education->jobseeker_profile_id = $id;
            $education->created_at = date('Y-m-d H:i:s');
            $education->save();
        }
    }
    /**
     * Function to save character references
     */
    public function save_character_references(Request $request){
     

     
        $JobSeekerProfile = JobSeekerProfile::find(Auth::user()->id);
        $id = $JobSeekerProfile->id;
        for($counter = 0; $counter < count($request->name); $counter++){
            $reference = new CharacterReferences();
            $reference->name = $request->name[$counter];
            $reference->email = $request->email[$counter];
            $reference->company_name = $request->company_name[$counter];
            $reference->designation = $request->designation[$counter];
            $reference->jobseeker_profile_id = $id;
            $reference->created_at = date('Y-m-d H:i:s');
            $reference->save();
        }
    }
    public function save_contact_details(Request $request){
     
        $contact = new JobSeekerProfile();
        $JobSeekerProfile = JobSeekerProfile::find(Auth::user()->id);
        $secondary_email = $JobSeekerProfile->secondary_email;
        $secondary_mobile_number = $JobSeekerProfile->secondary_mobile_number;
        $contact->secondary_email  = $request->secondary_email ;
        $contact->secondary_mobile_number =  $request->secondary_mobile_number ;
       
        if($secondary_email=='' ||$secondary_mobile_number=='')
                $contact->save();
        else

               $affectedRows = JobSeekerProfile::where('id', '=', Auth::user()->id)->update(array('secondary_email' => $request->secondary_email,'secondary_mobile_number' => $request->secondary_mobile_number));
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
     
     
    
            $id =    Auth::user()->id;
            $Profession_id = Profession::where('profession_name',$request->Profession)->first();
            $profession_id=$Profession_id['id'];
            $JobSeekerProfile = JobSeekerProfile::find(Auth::user()->id);
            $skills = $JobSeekerProfile->skills;
            $Profession = new JobSeekerProfile();
            $Profession->skills = $request->skills;
            $Profession->profession_id = $profession_id;
            // if($skills=='')
            //     $Profession->save();
            //  else

             $affectedRows = JobSeekerProfile::where('id', '=', Auth::user()->id)->update(array('skills' => $request->skills,'profession_id' => $profession_id));

    }

    
public function show_my_profile($id)
{
    $profile = JobSeekerProfile::find($id);
    // dd($profile);
    return view('frontend.blog.blogview.career.my_career_profile', compact('profile'));
}

public function get_career_details(Request $request){

    $profile_id= $request->profile_id;
    $user_id= $request->user_id;
    $User_details = User::find($user_id);
    $JobSeekerProfile_details = JobSeekerProfile::find($profile_id);
    $Reference_details= CharacterReferences::where('jobseeker_profile_id', '=', $profile_id)->get();
    $work_experience= WorkExperience::where('jobseeker_profile_id', '=', $profile_id)->get();
    $Education_details= Education::where('jobseeker_profile_id', '=', $profile_id)->get();
//  dd($Education_details);
    $resultData=array('User_details'=>$User_details,'JobSeekerProfile_details'=>$JobSeekerProfile_details,'Reference_details'=>$Reference_details,'work_experience'=>$work_experience,'Education_details'=>$Education_details);
    return  $resultData;
    // dd( $User_details);
    
}

public function edit_profile(Request $request)
{
   
  $user = Auth::user();
  $profile = JobSeekerProfile::find($user->id);
  return view('frontend.user.edit-setup-profile',compact('user','profile'));
}

    }