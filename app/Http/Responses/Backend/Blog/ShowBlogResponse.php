<?php

namespace App\Http\Responses\Backend\Blog;

use Illuminate\Contracts\Support\Responsable;

class ShowBlogResponse implements Responsable
{
    protected $blog;

    protected $status;

    protected $blogTags;

    public function __construct($blog, $status,$blogTags,$comments,$emotions)
    {

        $this->blog = $blog;
        $this->status = $status;
        $this->blogTags = $blogTags;
        $this->comments = $comments;
        $this->emotions = $emotions;
    }

    public function toResponse($request)
    {
        $selectedtags = $this->blog->tags->pluck('id')->toArray();
        // dd($this->comments, $this->emotions);
        return view('backend.blogs.show')->with([
            'blog'               => $this->blog,
            'blogTags'           => $this->blogTags,
            'selectedtags'       => $selectedtags,
            'status'             => $this->status,
            'comments'           =>  $this->comments,
            'emotions'          => $this->emotions,
        ]);
    }
}
