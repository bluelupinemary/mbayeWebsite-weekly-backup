<?php

namespace App\Http\Requests\Backend\JobSeekers;

use App\Http\Requests\Request;

/**
 * Class ManageJobSeekersRequest.
 */
class ManageJobSeekersRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('view-profile');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
