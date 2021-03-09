<?php

namespace App\Repositories\Backend\Career;

use Carbon\Carbon;
use App\Models\JobSeekerProfile\JobSeekerProfile;
use Illuminate\Support\Str;
use App\Models\JobSeekerProfile\Education;
use App\Models\JobSeekerProfile\CharacterReferences;
use App\Models\JobSeekerProfile\Profession;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Models\JobSeekerProfile\WorkExperience;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Storage;

/**
 * Class BlogsRepository.
 */
class JobSeekerRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = JobSeekerProfile::class;
    /**
     * @return mixed
     */
    public function getForDataTable()
    {

        return $this->query()
        ->leftjoin(config('module.professions.table'), config('module.professions.table').'.id', '=', config('module.job_seeker_profiles.table').'.profession_id')
            ->select([
                config('module.job_seeker_profiles.table').'.id',
                config('module.job_seeker_profiles.table').'.secondary_email',
                config('module.job_seeker_profiles.table').'.secondary_mobile_number',
                config('module.job_seeker_profiles.table').'.present_city',
                config('module.job_seeker_profiles.table').'.state',
                config('module.job_seeker_profiles.table').'.present_country',
                config('module.professions.table').'.profession_name',
                
            ]);
    }
    /**
     * @param \App\Models\jobseekers\JobSeeker $blog
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(JobSeekerProfile $jobseeker)
    {
        DB::transaction(function () use ($jobseeker) {
            if ($jobseeker->delete()) {
                Education::where('jobseeker_profile_id', $jobseeker->id)->delete();
                WorkExperience::where('jobseeker_profile_id', $jobseeker->id)->delete();
                Education::where('jobseeker_profile_id', $jobseeker->id)->delete();
                // event(new BlogDeleted($blog));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.blogs.delete_error'));
        });
    }

    public function restore($blog)
    {
        if (is_null($blog->deleted_at)) {
            throw new GeneralException(trans('exceptions.backend.access.users.cant_restore'));
        }

        if ($blog->restore()) {
            // event(new UserRestored($user));

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.restore_error'));
    }

    /**
     * @param $user
     *
     * @throws GeneralException
     */
    public function forceDelete($blog)
    {
        if (is_null($blog->deleted_at)) {
            throw new GeneralException(trans('exceptions.backend.access.users.delete_first'));
        }

        DB::transaction(function () use ($blog) {
            if ($blog->forceDelete()) {
                // event(new UserPermanentlyDeleted($user));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.access.users.delete_error'));
        });
    }
}
