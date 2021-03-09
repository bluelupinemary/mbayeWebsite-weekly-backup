<?php

namespace App\Http\Requests\Backend\Professions;

use App\Http\Requests\Request;

/**
 * Class UpdateProfessionRequest.
 */
class UpdateProfessionRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-blog-tag');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'profession_name' => 'required|max:191|unique:professions,name,'.$this->segment(3),
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
            'profession_name.unique'   => 'Profession name already exists, please enter a different name.',
            'profession_name.required' => 'Profession name is a required field.',
            'profession_name.max'      => 'Profession may not be greater than 191 characters.',
        ];
    }
}
