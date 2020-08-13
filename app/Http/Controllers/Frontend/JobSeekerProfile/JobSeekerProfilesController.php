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
use App\Models\JobSeekerProfile\JobSeekerProfile;
use App\Models\JobSeekerProfile\WorkExperience;
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
     dd( $request);
            $JobSeekerProfile = JobSeekerProfile::find(Auth::user()->id);
            $id = $JobSeekerProfile->id;
            $work_experience = new WorkExperience();
            $work_experience->designation = $request->designation;
            $work_experience->company_name = $request->company_name;
            $work_experience->address = $request->address;
            $work_experience->role = $request->role;
            $work_experience->contact_no = $request->contact_no;
            $work_experience->start_date = $request->start_date;
            $work_experience->end_date = $request->end_date;
            $work_experience->jobseeker_profile_id = $id;
            $work_experience->created_at = date('Y-m-d H:i:s');
            $work_experience->save();
        }
        /**
     * Function to save details into education
     */
    public function save_education(Request $request){
     
        $JobSeekerProfile = JobSeekerProfile::find(Auth::user()->id);
        $id = $JobSeekerProfile->id;
        $education = new Education();
        $education->school_name = $request->school_name;
        $education->field_of_study = $request->field_of_study;
        $education->start_date = $request->start_date;
        $education->end_date = $request->end_date;
        $education->description = $request->description;
        $education->jobseeker_profile_id = $id;
        $education->created_at = date('Y-m-d H:i:s');
        $education->save();
    }
    /**
     * Function to save character references
     */
    public function save_character_references(Request $request){
     
        $JobSeekerProfile = JobSeekerProfile::find(Auth::user()->id);
        $id = $JobSeekerProfile->id;
        $reference = new CharacterReferences();
        $reference->name = $request->name;
        $reference->email = $request->email;
        $reference->company_name = $request->company_name;
        $reference->designation = $request->designation;
        $reference->jobseeker_profile_id = $id;
        $reference->created_at = date('Y-m-d H:i:s');
        $reference->save();
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
    
}
