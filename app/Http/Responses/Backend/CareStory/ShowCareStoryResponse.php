<?php

namespace App\Http\Responses\Backend\CareStory;

use Illuminate\Contracts\Support\Responsable;

class ShowCareStoryResponse implements Responsable
{
    protected $carestory;

    protected $status;

    public function __construct($carestory, $status)
    {

        $this->carestory = $carestory;
        $this->status = $status;
    }

    public function toResponse($request)
    {
        return view('backend.carestory.show')->with([
            'carestory'               => $this->carestory,
            'status'             => $this->status,
        ]);
    }
}
