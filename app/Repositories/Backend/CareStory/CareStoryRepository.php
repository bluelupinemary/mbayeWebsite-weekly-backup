<?php

namespace App\Repositories\Backend\CareStory;

use App\Exceptions\GeneralException;
use App\Models\CareStories\CareStory;
use App\Repositories\BaseRepository;
use DB;

/**
 * Class CareStoryRepository.
 */
class CareStoryRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = CareStory::class;

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
        ->leftjoin(config('access.users_table'), config('access.users_table').'.id', '=', config('module.care_stories.table').'.created_by')
        ->select([
            config('module.care_stories.table').'.id',
            config('module.care_stories.table').'.name',
            config('module.care_stories.table').'.featured_image',
            config('module.care_stories.table').'.publish_datetime',
            config('module.care_stories.table').'.status',
            config('module.care_stories.table').'.panel_number',
            config('module.care_stories.table').'.created_by',
            config('module.care_stories.table').'.created_at',
            config('access.users_table').'.first_name as first_name',
            config('access.users_table').'.last_name as last_name',
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
    //     if ($this->query()->where('name', $input['name'])->first()) {
    //         throw new GeneralException(trans('exceptions.backend.blogtags.already_exists'));
    //     }

    //     DB::transaction(function () use ($input) {
    //         $input['status'] = isset($input['status']) ? 1 : 0;
    //         $input['created_by'] = access()->user()->id;

    //         if ($blogtag = BlogTag::create($input)) {
    //             event(new BlogTagCreated($blogtag));

    //             return true;
    //         }

    //         throw new GeneralException(trans('exceptions.backend.blogtags.create_error'));
    //     });
    // }

    /**
     * @param \App\Models\BlogTags\BlogTag $blogtag
     * @param  $input
     *
     * @throws \App\Exceptions\GeneralException
     *
     * return bool
     */
    // public function update(BlogTag $blogtag, array $input)
    // {
    //     if ($this->query()->where('name', $input['name'])->where('id', '!=', $blogtag->id)->first()) {
    //         throw new GeneralException(trans('exceptions.backend.blogtags.already_exists'));
    //     }

    //     DB::transaction(function () use ($blogtag, $input) {
    //         $input['status'] = isset($input['status']) ? 1 : 0;
    //         $input['updated_by'] = access()->user()->id;

    //         if ($blogtag->update($input)) {
    //             event(new BlogTagUpdated($blogtag));

    //             return true;
    //         }

    //         throw new GeneralException(
    //             trans('exceptions.backend.blogtags.update_error')
    //         );
    //     });
    // }

    /**
     * @param \App\Models\BlogTags\BlogTag $blogtag
     *
     * @throws \App\Exceptions\GeneralException
     *
     * @return bool
     */
    public function delete(CareStory $carestory)
    {
        DB::transaction(function () use ($carestory) {
            if ($carestory->delete()) {
                // event(new BlogTagDeleted($blogtag));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.blogtags.delete_error'));
        });
    }
}
