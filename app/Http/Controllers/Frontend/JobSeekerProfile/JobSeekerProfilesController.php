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
}
