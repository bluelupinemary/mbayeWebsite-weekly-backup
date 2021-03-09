<?php

namespace App\Http\Responses\Backend\Company;

use Illuminate\Contracts\Support\Responsable;

class IndexCompanyResponse implements Responsable
{
    protected $companyprofile;

    public function __construct($companyprofile)
    {
        $this->companyprofile = $companyprofile;
    }

    public function toResponse($request)
    {
        return view('backend.companyprofile.index')->with([
            'companyprofile'=> $this->companyprofile,
        ]);
    }
}
