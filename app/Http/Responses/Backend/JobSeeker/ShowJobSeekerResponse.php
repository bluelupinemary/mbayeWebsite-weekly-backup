<?php

namespace App\Http\Responses\Backend\JobSeeker;

use Illuminate\Contracts\Support\Responsable;

class ShowJobSeekerResponse implements Responsable
{
    protected $jobseeker;
    protected $education;
    protected $workexp;
    protected $charref;

    public function __construct($jobseeker, $education,$workexp,$charref)
    {

        $this->jobseeker = $jobseeker;
        $this->education = $education;
        $this->workexp = $workexp;
        $this->charref = $charref;
    }

    public function toResponse($request)
    {
        return view('backend.jobseeker.show')->with([
            'jobseeker'               => $this->jobseeker,
            'education'           => $this->education,
            'workexp'       => $this->workexp,
            'charref'             => $this->charref,
        ]);
    }
}
