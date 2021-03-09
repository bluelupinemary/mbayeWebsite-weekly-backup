<?php

namespace App\Http\Controllers\Backend\JobSeekers;

use App\Models\JobSeekerProfile\JobSeekerProfile;
use App\Models\Access\User\User;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Repositories\Backend\Career\JobSeekerRepository;
use App\Http\Requests\Backend\JobSeekers\CreateJobSeekersRequest;
use App\Http\Requests\Backend\JobSeekers\DeleteJobSeekersRequest;
use App\Http\Requests\Backend\JobSeekers\EditJobSeekersRequest;
use App\Http\Requests\Backend\JobSeekers\ManageJobSeekersRequest;
use App\Http\Requests\Backend\JobSeekers\ShowJobSeekersRequest;
use App\Http\Requests\Backend\JobSeekers\StoreJobSeekersRequest;
use App\Http\Requests\Backend\JobSeekers\UpdateJobSeekersRequest;
use App\Http\Responses\Backend\JobSeeker\CreateJobSeekerResponse;
use App\Http\Responses\Backend\JobSeeker\EditJobSeekerResponse;
use App\Http\Responses\Backend\JobSeeker\IndexJobSeekerResponse;
use App\Http\Responses\Backend\JobSeeker\ShowJobSeekerResponse;
use App\Models\JobSeekerProfile\Profession;

/**
 * Class JobSeekerController.
 */
class JobSeekersController extends Controller
{

    /**
     * @var JobSeekerRepository
     */
    protected $jobseeker;

    /**
     * @param \App\Repositories\Backend\Blogs\BlogsRepository $blog
     */
    public function __construct(JobSeekerRepository $jobseeker)
    {
        $this->jobseeker = $jobseeker;
    }

    /**
     * @param \App\Http\Requests\Backend\Blogs\ManageBlogsRequest $request
     *
     * @return \App\Http\Responses\Backend\Blog\IndexResponse
     */
    public function index(ManageJobSeekersRequest $request)
    {
        // $tags = BlogTag::all();
        // $tags = $tags->mapWithKeys(function ($item) {
        //     return [$item['name'] => $item['name']];
        // });
        // $tags->all();
        // dd($tags);
        return new IndexJobSeekerResponse($this->jobseeker);
    }

    /**
     * @param \App\Http\Requests\Backend\Blogs\ManageBlogsRequest $request
     *
     * @return mixed
     */
    // public function create(ManageJobSeekersRequest $request)
    // {
    //     $professions = Profession::all()->pluck('profession_name');
    //     dd($professions);
    //     return new CreateJobSeekerResponse($professions);
    // }

    /**
     * @param \App\Http\Requests\Backend\Blogs\StoreBlogsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    // public function store(StoreBlogsRequest $request)
    // {
    //     $this->blog->create($request->except('_token'));

    //     return new RedirectResponse(route('admin.blogs.index'), ['flash_success' => trans('alerts.backend.blogs.created')]);
    // }

    public function show(JobSeekerProfile $jobseeker, ManageJobSeekersRequest $request)
    {
        $education = $jobseeker->education;
        $workexp = $jobseeker->workexp;
        $cahrref = $jobseeker->charref;
        // dd($education);
        return new ShowJobSeekerResponse($jobseeker, $education,$workexp,$cahrref);
    }

    /**
     * @param \App\Models\Blogs\Blog                              $blog
     * @param \App\Http\Requests\Backend\Blogs\ManageBlogsRequest $request
     *
     * @return \App\Http\Responses\Backend\Blog\EditResponse
     */
    // public function edit(Blog $blog, ManageBlogsRequest $request)
    // {
    //     $blogTags = BlogTag::getSelectData();
    //     return new EditBlogResponse($blog, $this->status, $blogTags);
    // }

    /**
     * @param \App\Models\Blogs\Blog                              $blog
     * @param \App\Http\Requests\Backend\Blogs\UpdateBlogsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */

    // public function update(Blog $blog, UpdateBlogsRequest $request)
    // {
    //     $input = $request->all();

    //     $this->blog->update($blog, $request->except(['_token', '_method']));

    //     return new RedirectResponse(route('admin.blogs.index'), ['flash_success' => trans('alerts.backend.blogs.updated')]);
    // }

    /**
     * @param \App\Models\Blogs\Blog                              $blog
     * @param \App\Http\Requests\Backend\Blogs\ManageBlogsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(JobSeekerProfile $jobseeker, ManageJobSeekersRequest $request)
    {
        $this->jobseeker->delete($jobseeker);
        return new RedirectResponse(route('admin.jobseekers.index'), ['flash_success' => 'Deleted']);
    }

   
}
