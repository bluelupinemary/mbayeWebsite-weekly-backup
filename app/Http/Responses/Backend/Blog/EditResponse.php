<?php

namespace App\Http\Responses\Backend\Blog;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    protected $blog;

    protected $status;

    protected $blogTags;

    public function __construct($blog, $status,$blogTags)
    {
        $this->blog = $blog;
        $this->status = $status;
        $this->blogTags = $blogTags;
    }

    public function toResponse($request)
    {
        $selectedtags = $this->blog->tags->pluck('id')->toArray();

        return view('backend.blogs.edit')->with([
            'blog'               => $this->blog,
            'blogTags'           => $this->blogTags,
            'selectedtags'       => $selectedtags,
            'status'             => $this->status,
        ]);
    }
}
