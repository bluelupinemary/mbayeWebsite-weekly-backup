<?php

namespace App\Repositories\Frontend\CompanyProfile;

use DB;
use Image;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Access\User\User;
use App\Models\Company\DemoCompany;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Storage;
use App\Models\Company\CompanyProfile;
// use App\Http\Controllers\Frontend\DemoFormsubmit;


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
        $this->upload_path = 'career'.DIRECTORY_SEPARATOR.'company'.DIRECTORY_SEPARATOR;
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
    // public function create(array $input)
    // {
    //     // dd($input);
    //     DB::beginTransaction();
    //      $input['featured_image'] = $this->uploadImage($input);

    //     if ($data = CompanyProfile::create($input)) {
    //         DB::commit();
    //         return $data;
    //     }
    // }
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

      if ($data = CompanyProfile::create($input)) {
          DB::commit();
          return $data;
      }
    }


    /**
     * Update Profile.
     *
     */
    public function update(CompanyProfile $profile, array $input)
    {
        // dd($input);
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
    public function delete(CompanyProfile $profile)
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
        // dd($input);
        $avatar = $input['featured_image'];
        // dd($avatar);
        if (isset($input['featured_image']) && !empty($input['featured_image'])) {
            $fileName =time().$avatar->getClientOriginalName();

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
        while (Storage::exists('public/career/company/'.$filename)) {
            $filename = Str::random().'.jpg';
        }

        Storage::disk('local')->put('public/career/company/'.$filename, $image);
        
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
