<?php

namespace App\Http\Requests\Backend\Professions;

use App\Http\Requests\Request;

/**
 * Class StoreProfessionRequest.
 */
class StoreProfessionRequest extends Request
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
            'profession_name' => 'required|max:191',
        ];
    }

    /**
     * Get the custom validation messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'profession_name.required' => 'Profession name is a required field.',
            'profession_name.max'      => 'Profession may not be greater than 191 characters.',
        ];
    }
}
