<?php

namespace App\Http\Requests\Backend\Industries;

use App\Http\Requests\Request;

/**
 * Class UpdateIndustryRequest.
 */
class UpdateIndustryRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-industry');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'industry_name' => 'required|max:191|unique:industries,industry_name,'.$this->segment(3),
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
            'industry_name.unique'   => 'Industry name already exists, please enter a different name.',
            'industry_name.required' => 'Industry name is a required field.',
            'industry_name.max'      => 'Industry may not be greater than 191 characters.',
        ];
    }
}
