<?php

namespace App\Http\Controllers\Backend\CareStory;

use App\Http\Controllers\Controller;
use App\Http\Responses\ViewResponse;
use App\Models\CareStories\CareStory;
use App\Http\Responses\RedirectResponse;
use App\Repositories\Backend\CareStory\CareStoryRepository;
use App\Http\Responses\Backend\CareStory\ShowCareStoryResponse;
use App\Http\Responses\Backend\CareStory\IndexCareStoryResponse;
use App\Http\Requests\Backend\CareStories\ManageCareStoriesRequest;;

/**
 * Class CareStoryController.
 */
class CareStoryController extends Controller
{

    protected $status = [
        'Published' => 'Published',
        'Draft'     => 'Draft',
        'InActive'  => 'InActive',
        'Scheduled' => 'Scheduled',
    ];
    /**
     * @var \App\Repositories\Backend\CareStory\CareStoryRepository
     */
    protected $carestory;

    /**
     * @param \App\Repositories\Backend\CareStory\CareStoryRepository $carestory
     */
    public function __construct(CareStoryRepository $carestory)
    {
        $this->carestory = $carestory;
    }

    /**
     * @param \App\Http\Requests\Backend\CareStories\ManageCareStoriesRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageCareStoriesRequest $request)
    {
        return new IndexCareStoryResponse($this->status);
    }

    public function show(CareStory $carestory, ManageCareStoriesRequest $request)
    {
        // dd($emotions);
        return new ShowCareStoryResponse($carestory, $this->status);
    }

    /**
     * @param \App\Http\Requests\Backend\BlogTags\CreateBlogTagsRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    // public function create(CreateBlogTagsRequest $request)
    // {
    //     return new ViewResponse('backend.blogtags.create');
    // }

    /**
     * @param \App\Http\Requests\Backend\BlogTags\StoreBlogTagsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    // public function store(StoreBlogTagsRequest $request)
    // {
    //     $this->blogtag->create($request->except('token'));

    //     return new RedirectResponse(route('admin.blogTags.index'), ['flash_success' => trans('alerts.backend.blogtags.created')]);
    // }

    /**
     * @param \App\Models\BlogTags\BlogTag                            $blogTag
     * @param \App\Http\Requests\Backend\BlogTags\EditBlogTagsRequest $request
     *
     * @return \App\Http\Responses\Backend\BlogTag\EditResponse
     */
    // public function edit(BlogTag $blogTag, EditBlogTagsRequest $request)
    // {
    //     return new EditResponse($blogTag);
    // }

    /**
     * @param \App\Models\BlogTags\BlogTag                              $blogTag
     * @param \App\Http\Requests\Backend\BlogTags\UpdateBlogTagsRequest $request
     *
     * @return mixed
     */
    // public function update(BlogTag $blogTag, UpdateBlogTagsRequest $request)
    // {
    //     $this->blogtag->update($blogTag, $request->except(['_method', '_token']));

    //     return new RedirectResponse(route('admin.blogTags.index'), ['flash_success' => trans('alerts.backend.blogtags.updated')]);
    // }

    /**
     * @param \App\Models\BlogTags\BlogTag                              $blogTag
     * @param \App\Http\Requests\Backend\BlogTags\DeleteBlogTagsRequest $request
     *
     * @return mixed
     */
    public function destroy(CareStory $carestory, ManageCareStoriesRequest $request)
    {
        $this->carestory->delete($carestory);

        return new RedirectResponse(route('admin.carestory.index'), ['flash_success' => trans('alerts.backend.blogtags.deleted')]);
    }
}
