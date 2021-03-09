<?php

namespace App\Repositories\Backend\Company;

use Carbon\Carbon;
use App\Models\Company\CompanyProfile;
use Illuminate\Support\Str;;
use App\Models\Company\Industry;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Storage;

/**
 * Class CompanyRepository.
 */
class CompanyRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = CompanyProfile::class;
    /**
     * @return mixed
     */
    public function getForDataTable()
    {

        return $this->query()
        ->leftjoin(config('access.users_table'), config('access.users_table').'.id', '=', config('module.company_profiles.table').'.owner_id')
        ->leftjoin(config('module.industries.table'), config('module.industries.table').'.id', '=', config('module.company_profiles.table').'.industry_id')
            ->select([
                config('module.company_profiles.table').'.id',
                // config('access.users_table').'.first_name',
                // config('access.users_table').'.last_name',
                config('module.company_profiles.table').'.owner_id',
                config('module.company_profiles.table').'.company_name',
                config('module.company_profiles.table').'.company_email',
                config('module.company_profiles.table').'.company_phone_number',
                config('module.company_profiles.table').'.state',
                config('module.company_profiles.table').'.city',
                config('module.company_profiles.table').'.country',
                config('module.company_profiles.table').'.address',
                config('module.company_profiles.table').'.industry_id',
                
            ]);
    }
    /**
     * @param \App\Models\company\CompanyProfile $CompanyProfile
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(CompanyProfile $companyprofile)
    {
        DB::transaction(function () use ($companyprofile) {
            if ($companyprofile->delete()) {
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.blogs.delete_error'));
        });
    }

    // public function restore($companyprofile)
    // {
    //     if (is_null($companyprofile->deleted_at)) {
    //         throw new GeneralException(trans('exceptions.backend.access.users.cant_restore'));
    //     }

    //     if ($companyprofile->restore()) {
    //         // event(new UserRestored($user));

    //         return true;
    //     }

    //     throw new GeneralException(trans('exceptions.backend.access.users.restore_error'));
    // }

    /**
     * @param $user
     *
     * @throws GeneralException
     */
    // public function forceDelete($blog)
    // {
    //     if (is_null($blog->deleted_at)) {
    //         throw new GeneralException(trans('exceptions.backend.access.users.delete_first'));
    //     }

    //     DB::transaction(function () use ($blog) {
    //         if ($blog->forceDelete()) {
    //             // event(new UserPermanentlyDeleted($user));

    //             return true;
    //         }

    //         throw new GeneralException(trans('exceptions.backend.access.users.delete_error'));
    //     });
    // }
}
