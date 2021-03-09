<?php

namespace App\Http\Controllers\Backend\JobSeekers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Professions\CreateProfessionRequest;
use App\Http\Requests\Backend\Professions\DeleteProfessionRequest;
use App\Http\Requests\Backend\Professions\EditProfessionRequest;
use App\Http\Requests\Backend\Professions\ManageProfessionRequest;
use App\Http\Requests\Backend\Professions\StoreProfessionRequest;
use App\Http\Requests\Backend\Professions\UpdateProfessionRequest;
use App\Http\Responses\Backend\Profession\EditResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\JobSeekerProfile\Profession;
use App\Repositories\Backend\Career\ProfessionRepository;

/**
 * Class Profession.
 */
class ProfessionsController extends Controller
{
    /**
     * @var \App\Repositories\Backend\Career\ProfessionRepository
     */
    protected $profession;

    /**
     * @param \App\Repositories\Backend\Career\ProfessionRepository $profession
     */
    public function __construct(ProfessionRepository $profession)
    {
        $this->profession = $profession;
    }

    /**
     * @param \App\Http\Requests\Backend\Professions\ManageProfessionRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageProfessionRequest $request)
    {
        return new ViewResponse('backend.professions.index');
    }

    /**
     * @param \App\Http\Requests\Backend\Professions\CreateProfessionRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function create(CreateProfessionRequest $request)
    {
        return new ViewResponse('backend.professions.create');
    }

    /**
     * @param \App\Http\Requests\Backend\Professions\StoreProfessionRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreProfessionRequest $request)
    {
        $this->profession->create($request->except('token'));

        return new RedirectResponse(route('admin.professions.index'), ['flash_success' => 'Profession Created Successfully']);
    }

    /**
     * @param \App\Models\JobSeekerProfile\Profession                            $profession
     * @param \App\Http\Requests\Backend\Professions\EditProfessionRequest $request
     *
     * @return \App\Http\Responses\Backend\Profession\EditResponse
     */
    public function edit(Profession $profession, EditProfessionRequest $request)
    {
        return new EditResponse($profession);
    }

    /**
     * @param \App\Models\JobSeekerProfile\Profession                              $profession
     * @param \App\Http\Requests\Backend\Professions\UpdateProfessionRequest $request
     *
     * @return mixed
     */
    public function update(Profession $profession, UpdateProfessionRequest $request)
    {
        $this->profession->update($profession, $request->except(['_method', '_token']));

        return new RedirectResponse(route('admin.professions.index'), ['flash_success' => 'Profession Updated Successfully']);
    }

    /**
     * @param \App\Models\JobSeekerProfile\Profession                              $profession
     * @param \App\Http\Requests\Backend\Professions\DeleteProfessionRequest $request
     *
     * @return mixed
     */
    public function destroy(Profession $profession, DeleteProfessionRequest $request)
    {
        $this->profession->delete($profession);

        return new RedirectResponse(route('admin.professions.index'), ['flash_success' => 'Profession Deleted Successfully']);
    }
}
