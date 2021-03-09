<?php

namespace App\Http\Controllers\Backend\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Industries\UpdateIndustryRequest;
use App\Http\Requests\Backend\Industries\StoreIndustryRequest;
use App\Http\Requests\Backend\Industries\ManageIndustryRequest;
use App\Http\Requests\Backend\Industries\EditIndustryRequest;
use App\Http\Requests\Backend\Industries\DeleteIndustryRequest;
use App\Http\Requests\Backend\Industries\CreateIndustryRequest;
use App\Http\Responses\Backend\Industry\EditResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\Company\Industry;
use App\Repositories\Backend\Company\IndustryRepository;

/**
 * Class Industry.
 */
class IndustriesController extends Controller
{
    /**
     * @var \App\Repositories\Backend\Career\IndustryRepository
     */
    protected $industry;

    /**
     * @param \App\Repositories\Backend\Career\IndustryRepository $industry
     */
    public function __construct(IndustryRepository $industry)
    {
        $this->industry = $industry;
    }

    /**
     * @param \App\Http\Requests\Backend\Industries\ManageIndustryRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageIndustryRequest $request)
    {
        return new ViewResponse('backend.industries.index');
    }

    /**
     * @param \App\Http\Requests\Backend\Industries\CreateIndustryRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function create(CreateIndustryRequest $request)
    {
        return new ViewResponse('backend.industries.create');
    }

    /**
     * @param \App\Http\Requests\Backend\Industries\StoreIndustryRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreIndustryRequest $request)
    {
        $this->industry->create($request->except('token'));

        return new RedirectResponse(route('admin.industries.index'), ['flash_success' => 'Industry Created Successfully']);
    }

    /**
     * @param \App\Models\JobSeekerProfile\Industry                            $industry
     * @param \App\Http\Requests\Backend\Industries\EditIndustryRequest $request
     *
     * @return \App\Http\Responses\Backend\Industry\EditResponse
     */
    public function edit(Industry $industry, EditIndustryRequest $request)
    {
        return new EditResponse($industry);
    }

    /**
     * @param \App\Models\Company\Industry                              $industry
     * @param \App\Http\Requests\Backend\Industries\UpdateIndustryRequest $request
     *
     * @return mixed
     */
    public function update(Industry $industry, UpdateIndustryRequest $request)
    {
        $this->industry->update($industry, $request->except(['_method', '_token']));

        return new RedirectResponse(route('admin.industries.index'), ['flash_success' => 'Industry Updated Successfully']);
    }

    /**
     * @param \App\Models\Company\Industry                              $industry
     * @param \App\Http\Requests\Backend\Industries\DeleteIndustryRequest $request
     *
     * @return mixed
     */
    public function destroy(Industry $industry, DeleteIndustryRequest $request)
    {
        $this->industry->delete($industry);

        return new RedirectResponse(route('admin.industries.index'), ['flash_success' => 'Industry Deleted Successfully']);
    }
}
