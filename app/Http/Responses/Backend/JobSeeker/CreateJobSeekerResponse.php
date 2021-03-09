<?php

namespace App\Http\Responses\Backend\JobSeeker;

use Illuminate\Contracts\Support\Responsable;

class CreateJobSeekerResponse implements Responsable
{
    protected $professions;

    // protected $blogTags;

    public function __construct($professions)
    {
        $this->professions = $professions;
    }

    public function toResponse($request)
    {
        return view('backend.jobseeker.create')->with([
            'professions'       => $this->professions,
        ]);
    }
}
