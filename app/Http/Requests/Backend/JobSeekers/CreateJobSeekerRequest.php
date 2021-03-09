<?php

namespace App\Http\Requests\Backend\JobSeekers;

use App\Http\Requests\Request;

/**
 * Class CreateJobSeekersRequest.
 */
class CreateJobSeekersRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-profile');
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
