<?php

namespace App\Repositories\Frontend\CompanyProfile;

use App\Exceptions\GeneralException;
use App\Models\CompanyProfile\CompanyProfile;
use App\Models\Access\User\User;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;


class CompanyProfilesRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = CompanyProfile::class;

    protected $upload_path;

    /**
     * Storage Class Object.
     *
     * @var \Illuminate\Support\Facades\Storage
     */
    protected $storage;

    public function __construct()
    {
        $this->upload_path = 'img'.DIRECTORY_SEPARATOR.'ComapnyProfile'.DIRECTORY_SEPARATOR;
        $this->storage = Storage::disk('public');
    }

    public function getForDataTable()
  {
   // dd("gh");
        return $this->query()
            ->leftjoin(config('access.users_table'), config('access.users_table').'.id', '=', config('module.company_profiles.table').'.owner_id')
            ->leftJoin('industries AS i', 'i.id', '=','company_profiles.industry_id' )
            ->select([
                config('module.company_profiles.table').'.id',
                config('module.company_profiles.table').'.company_name',
                config('module.company_profiles.table').'.company_email',
                config('module.company_profiles.table').'.featured_image',
                config('module.company_profiles.table').'.company_phone_number',
                config('module.company_profiles.table').'.industry_id',
                config('module.company_profiles.table').'.user_id',
                config('module.company_profiles.table').'.created_at',
                config('module.company_profiles.table').'.updated_at',
                config('access.users_table').'.first_name as user_name',
                config('access.users_table').'.last_name as last_name',
                config('access.users_table').'.address as address',
                config('access.industries').'.industry_name',
                

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
    public function update(ComapnyProfile $profile, array $input)
    {
        
    }

    

    /**
     * @param 
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(ComapnyProfile $profile)
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
