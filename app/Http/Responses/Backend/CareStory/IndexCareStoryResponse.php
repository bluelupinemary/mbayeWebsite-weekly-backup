<?php

namespace App\Http\Responses\Backend\CareStory;

use Illuminate\Contracts\Support\Responsable;

class IndexCareStoryResponse implements Responsable
{
    protected $status;

    public function __construct($status)
    {
        $this->status = $status;
    }

    public function toResponse($request)
    {
        return view('backend.carestory.index')->with([
            'status'=> $this->status,
            // 'tags' => $this->tags,
        ]);
    }
}
