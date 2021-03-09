<?php

namespace App\Http\Requests\Backend\Industries;

use App\Http\Requests\Request;

/**
 * Class StoreIndustryRequest.
 */
class StoreIndustryRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-industries');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'industry_name' => 'required|max:191',
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
            'industry_name.required' => 'Industry name is a required field.',
            'industry_name.max'      => 'Industry may not be greater than 191 characters.',
        ];
    }
}
