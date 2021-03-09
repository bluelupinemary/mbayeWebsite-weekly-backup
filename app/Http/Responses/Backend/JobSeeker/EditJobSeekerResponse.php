<?php

namespace App\Http\Responses\Backend\JobSeeker;

use Illuminate\Contracts\Support\Responsable;

class EditJobSeekerResponse implements Responsable
{
    protected $jobseeker;

    // protected $status;

    // protected $blogTags;

    public function __construct($blog, $status,$blogTags)
    {
        // $this->blog = $blog;
        // $this->status = $status;
        // $this->blogTags = $blogTags;
    }

    public function toResponse($request)
    {
        // $selectedtags = $this->blog->tags->pluck('id')->toArray();

        return view('backend.jobseeker.edit')->with([
            // 'blog'               => $this->blog,
            // 'blogTags'           => $this->blogTags,
            // 'selectedtags'       => $selectedtags,
            // 'status'             => $this->status,
        ]);
    }
}
