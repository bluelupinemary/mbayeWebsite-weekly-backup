<?php

namespace App\Http\Responses\Backend\GeneralBlog;

use Illuminate\Contracts\Support\Responsable;

class IndexGeneralBlogResponse implements Responsable
{
    protected $status;

    public function __construct($status)
    {
        $this->status = $status;
    }

    public function toResponse($request)
    {
        return view('backend.generalblogs.index')->with([
            'status'=> $this->status,
        ]);
    }
}
