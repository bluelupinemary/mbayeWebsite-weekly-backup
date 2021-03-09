<?php

namespace App\Http\Requests\Backend\Professions;

use App\Http\Requests\Request;

/**
 * Class EditProfessionRequest.
 */
class EditProfessionRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-profession');
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
