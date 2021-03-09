<?php

namespace App\Http\Responses\Backend\JobSeeker;

use Illuminate\Contracts\Support\Responsable;

class IndexJobSeekerResponse implements Responsable
{
    protected $jobseeker;

    public function __construct($jobseeker)
    {
        $this->jobseeker = $jobseeker;
    }

    public function toResponse($request)
    {
        return view('backend.jobseeker.index')->with([
            'jobseeker'=> $this->jobseeker,
        ]);
    }
}
