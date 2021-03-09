<?php

namespace App\Http\Responses\Backend\Industry;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var 
     */
    protected $industry;

    /**
     * @param \App\Models\Company\Industry $industry
     */
    public function __construct($industry)
    {
        $this->industry = $industry;
    }

    /**
     * toReponse.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function toResponse($request)
    {
        return view('backend.Industries.edit')
            ->with('industry', $this->industry);
    }
}
