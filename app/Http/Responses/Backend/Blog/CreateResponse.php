<?php

namespace App\Http\Responses\Backend\Blog;

use Illuminate\Contracts\Support\Responsable;

class CreateResponse implements Responsable
{
    protected $status;

    protected $blogTags;

    public function __construct($status,$blogTags)
    {
        $this->status = $status;
        $this->blogTags = $blogTags;
    }

    public function toResponse($request)
    {
        return view('backend.blogs.create')->with([
            'blogTags'       => $this->blogTags,
            'status'         => $this->status,
        ]);
    }
}
