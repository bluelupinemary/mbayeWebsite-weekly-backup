<?php

namespace App\Http\Responses\Backend\Profession;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var 
     */
    protected $profession;

    /**
     * @param \App\Models\BlogTags\BlogTag $blogTag
     */
    public function __construct($profession)
    {
        $this->profession = $profession;
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
        return view('backend.professions.edit')
            ->with('profession', $this->profession);
    }
}
