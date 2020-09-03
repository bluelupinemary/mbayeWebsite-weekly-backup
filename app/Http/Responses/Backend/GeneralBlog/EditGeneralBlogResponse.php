<?php

namespace App\Http\Responses\Backend\GeneralBlog;

use Illuminate\Contracts\Support\Responsable;

class EditGeneralBlogResponse implements Responsable
{
    protected $blog;

    protected $status;

    public function __construct($blog, $status)
    {
        $this->blog = $blog;
        $this->status = $status;
    }

    public function toResponse($request)
    {
        // $selectedtags = $this->blog->tags->pluck('id')->toArray();
        // dd($this->blog);
        return view('backend.generalblogs.edit')->with([
            'blog'               => $this->blog,
            'status'             => $this->status,
        ]);
    }
}
