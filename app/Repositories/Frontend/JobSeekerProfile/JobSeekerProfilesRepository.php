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
        $this->upload_path = 'career'.DIRECTORY_SEPARATOR.'employee'.DIRECTORY_SEPARATOR;
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
    //    dd($input);
       DB::beginTransaction();
    //    $input['featured_image'] = $this->uploadImage($input);
    if($input['edited_featured_image']) {
        $input['featured_image'] = $this->uploadEditedImage($input['edited_featured_image']);
        // dd($input);
    } else if(array_key_exists('featured_image', $input)) {
        $input['featured_image'] = $this->uploadImage($input);
    }

      if ($data = JobSeekerProfile::create($input)) {
          DB::commit();
          return $data;
      }
    }
    

    /**
     * Update Profile.
     *
     */
    public function update(JobSeekerProfile $profile, array $input)
    {
        DB::beginTransaction();

        // if(array_key_exists('featured_image', $input)) {
        //     $this->deleteOldFile($profile);
        //     $input['featured_image'] = $this->uploadImage($input);
        // }
        if($input['edited_featured_image']) {
            $this->deleteOldFile($profile);
            $input['featured_image'] = $this->uploadEditedImage($input['edited_featured_image']);
        } else if (array_key_exists('featured_image', $input)) {
            $this->deleteOldFile($profile);
            $input['featured_image'] = $this->uploadImage($input);
        }

        if ($profile->update($input)) {
            DB::commit();
            return $profile;
        }
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

            // $input = array_merge($input, ['featured_image' => $fileName]);

            return $fileName;
        }
    }

    public function uploadEditedImage($featured_image)
    {
        // dd($featured_image);
        $avatar = $featured_image;
        // dd($avatar);
        $base64 = str_replace('data:image/png;base64,', '', $featured_image);
        $base64 = str_replace(' ', '+', $base64);
        $image = base64_decode($base64);

        // $user_photo = explode('.', $user->photo);
        $filename = Str::random().'.jpg';
        while (Storage::exists('public/career/employee/'.$filename)) {
            $filename = Str::random().'.jpg';
        }

        Storage::disk('local')->put('public/career/employee/'.$filename, $image);
        
        // compressing image
        // $source= 'storage/img/blog/'.$filename;
        // $quality=100;
        // $dest="storage/img/blog/".$filename;
        // $path= $this->compress($source,$dest, $quality);// compressing images

        return $filename;
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
