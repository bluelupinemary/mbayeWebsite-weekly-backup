<?php

namespace App\Http\Controllers\Backend\Company;

use App\Models\Company\CompanyProfile;
use App\Models\Access\User\User;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Repositories\Backend\Company\CompanyRepository;
use App\Http\Requests\Backend\CompanyProfile\ManageCompanyRequest;
use App\Http\Responses\Backend\Company\IndexCompanyResponse;
/**
 * Class JobSeekerController.
 */
class CompanyController extends Controller
{

    /**
     * @var CompanyRepository
     */
    protected $companyprofile;

    /**
     * @param \App\Repositories\Backend\Company\CompanyRepository $companyprofile
     */
    public function __construct(CompanyRepository $companyprofile)
    {
        $this->companyprofile = $companyprofile;
    }

    /**
     * @param \App\Http\Requests\Backend\Blogs\ManageBlogsRequest $request
     *
     * @return \App\Http\Responses\Backend\Blog\IndexResponse
     */
    public function index(ManageCompanyRequest $request)
    {
        // $tags = BlogTag::all();
        // $tags = $tags->mapWithKeys(function ($item) {
        //     return [$item['name'] => $item['name']];
        // });
        // $tags->all();
        // dd($tags);
        return new IndexCompanyResponse($this->companyprofile);
    }

    /**
     * @param \App\Models\Blogs\Blog                              $blog
     * @param \App\Http\Requests\Backend\Blogs\ManageBlogsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(CompanyProfile $companyprofile, ManageCompanyRequest $request)
    {
        $this->companyprofile->delete($companyprofile);
        return new RedirectResponse(route('admin.company.index'), ['flash_success' => 'Deleted']);
    }

   
}
