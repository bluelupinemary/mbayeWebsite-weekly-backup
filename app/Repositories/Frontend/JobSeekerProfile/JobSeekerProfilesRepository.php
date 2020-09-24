<?php

namespace App\Repositories\Frontend\JobSeekerProfile;

use App\Exceptions\GeneralException;
use App\Models\JobSeekerProfile\JobSeekerProfile;
use App\Models\JobSeekerProfile\Education;
use App\Models\JobSeekerProfile\WorkExperience;
use App\Models\JobSeekerProfile\CharacterReferences;
use App\Models\Access\User\User;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;


class JobSeekerProfilesRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = JobSeekerProfile::class;

    protected $upload_path;

    /**
     * Storage Class Object.
     *
     * @var \Illuminate\Support\Facades\Storage
     */
    protected $storage;

    public function __construct()
    {
        $this->upload_path = 'img'.DIRECTORY_SEPARATOR.'JobSeekerProfile'.DIRECTORY_SEPARATOR;
        $this->storage = Storage::disk('public');
    }

    public function getForDataTable()
  {
   // dd("gh");
        return $this->query()
            ->leftjoin(config('access.users_table'), config('access.users_table').'.id', '=', config('module.job_seeker_profiles.table').'.user_id')
            ->leftJoin('professions AS b', 'b.id', '=','job_seeker_profiles.profession_id' )
            ->select([
                config('module.job_seeker_profiles.table').'.id',
                config('module.job_seeker_profiles.table').'.secondary_email',
                config('module.job_seeker_profiles.table').'.secondary_mobile_number',
                config('module.job_seeker_profiles.table').'.featured_image',
                config('module.job_seeker_profiles.table').'.objective',
                config('module.job_seeker_profiles.table').'.skills',
                config('module.job_seeker_profiles.table').'.user_id',
                config('module.job_seeker_profiles.table').'.created_at',
                config('module.job_seeker_profiles.table').'.updated_at',
                config('access.users_table').'.first_name as user_name',
                config('access.users_table').'.last_name as last_name',
                config('access.users_table').'.country as country',
                config('access.profession').'.profession_name as profession',
                

            ]);
    }

    /**
     * @param array $input
     *
     * @throws \App\Exceptions\GeneralException
     *
     * @return bool
     */
    public function create(array $input)
    {
       
    }
    

    /**
     * Update Profile.
     *
     */
    public function update(JobSeekerProfile $profile, array $input)
    {
        
    }

    

    /**
     * @param 
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(JobSeekerProfile $profile)
    {
       
    }

    /**
     * Upload Image.
     *
     * @param array $input
     *
     * @return array $input
     */
    public function uploadImage($input)
    {
        $avatar = $input['featured_image'];

        if (isset($input['featured_image']) && !empty($input['featured_image'])) {
            $fileName = time().$avatar->getClientOriginalName();

            $this->storage->put($this->upload_path.$fileName, file_get_contents($avatar->getRealPath()));

            $input = array_merge($input, ['featured_image' => $fileName]);

            return $input;
        }
    }

    /**
     * Destroy Old Image.
     *
     * @param int $id
     */
    public function deleteOldFile($model)
    {
        $fileName = $model->featured_image;

        return $this->storage->delete($this->upload_path.$fileName);
    }
}
