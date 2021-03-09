<?php

namespace App\Repositories\Backend\Career;

use App\Exceptions\GeneralException;
use App\Models\JobSeekerProfile\Profession;
use App\Repositories\BaseRepository;
use DB;

/**
 * Class ProfessionRepository.
 */
class ProfessionRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Profession::class;

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                config('module.professions.table').'.id',
                config('module.professions.table').'.profession_name',
                config('module.professions.table').'.created_at',
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
        if ($this->query()->where('profession_name', $input['profession_name'])->first()) {
            throw new GeneralException('Already Exist');
        }

        DB::transaction(function () use ($input) {
            if ($profession = Profession::create($input)) {
                return true;
            }

            throw new GeneralException('Error');
        });
    }

    /**
     * @param \App\Models\JobSeekerProfile\Profession $Profession
     * @param  $input
     *
     * @throws \App\Exceptions\GeneralException
     *
     * return bool
     */
    public function update(Profession $profession, array $input)
    {
        if ($this->query()->where('profession_name', $input['profession_name'])->where('id', '!=', $profession->id)->first()) {
            throw new GeneralException('Already Exist');
        }

        DB::transaction(function () use ($profession, $input) {
            if ($profession->update($input)) {
                return true;
            }

            throw new GeneralException(
                'Error in Update'
            );
        });
    }

    /**
     * @param \App\Models\JobSeekerProfile\Profession $profession
     *
     * @throws \App\Exceptions\GeneralException
     *
     * @return bool
     */
    public function delete(Profession $profession)
    {
        DB::transaction(function () use ($profession) {
            if ($profession->delete()) {
                return true;
            }

            throw new GeneralException('exceptions.backend.blogtags.delete_error');
        });
    }
}
