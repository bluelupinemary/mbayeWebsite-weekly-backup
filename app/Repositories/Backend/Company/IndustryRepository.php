<?php

namespace App\Repositories\Backend\Company;

use App\Exceptions\GeneralException;
use App\Models\Company\Industry;
use App\Repositories\BaseRepository;
use DB;

/**
 * Class IndustryRepository.
 */
class IndustryRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Industry::class;

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                config('module.industries.table').'.id',
                config('module.industries.table').'.industry_name',
                config('module.industries.table').'.created_at',
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
        if ($this->query()->where('industry_name', $input['industry_name'])->first()) {
            throw new GeneralException('Already Exist');
        }

        DB::transaction(function () use ($input) {
            if ($industry = Industry::create($input)) {
                return true;
            }

            throw new GeneralException('Error');
        });
    }

    /**
     * @param \App\Models\JobSeekerProfile\Industry $Industry
     * @param  $input
     *
     * @throws \App\Exceptions\GeneralException
     *
     * return bool
     */
    public function update(Industry $industry, array $input)
    {
        if ($this->query()->where('industry_name', $input['industry_name'])->where('id', '!=', $industry->id)->first()) {
            throw new GeneralException('Already Exist');
        }

        DB::transaction(function () use ($industry, $input) {
            if ($industry->update($input)) {
                return true;
            }

            throw new GeneralException(
                'Error in Update'
            );
        });
    }

    /**
     * @param \App\Models\JobSeekerProfile\Industry $industry
     *
     * @throws \App\Exceptions\GeneralException
     *
     * @return bool
     */
    public function delete(Industry $industry)
    {
        DB::transaction(function () use ($industry) {
            if ($industry->delete()) {
                return true;
            }

            throw new GeneralException('exceptions.backend.blogtags.delete_error');
        });
    }
}
