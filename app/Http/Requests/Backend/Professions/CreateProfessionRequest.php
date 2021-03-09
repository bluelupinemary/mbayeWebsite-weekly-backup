<?php

namespace App\Http\Requests\Backend\Professions;

use App\Http\Requests\Request;

/**
 * Class CreateProfessionRequest.
 */
class CreateProfessionRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-profession');
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
