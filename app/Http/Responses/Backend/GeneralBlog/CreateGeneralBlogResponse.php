<?php

namespace App\Http\Responses\Backend\GeneralBlog;

use Illuminate\Contracts\Support\Responsable;

class CreateGeneralBlogResponse implements Responsable
{
    protected $status;

    public function __construct($status)
    {
        $this->status = $status;
        // $this->blogTags = $blogTags;
    }

    public function toResponse($request)
    {
        return view('backend.Generalblogs.create')->with([
            // 'blogTags'       => $this->blogTags,
            'status'         => $this->status,
        ]);
    }
}
