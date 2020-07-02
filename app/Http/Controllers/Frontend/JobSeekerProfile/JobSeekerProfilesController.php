<?php

namespace App\Http\Controllers\Frontend\JobSeekerProfile;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Access\User\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        dd(JobSeekerProfile::find(1)->charref);
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
