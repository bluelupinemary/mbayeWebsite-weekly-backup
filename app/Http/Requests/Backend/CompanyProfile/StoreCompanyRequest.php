<?php

namespace App\Http\Requests\Backend\CompanyProfile;

use App\Http\Requests\Request;

class StoreCompanyRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('view-frontend');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_name' => 'required',
            'company_email' => 'required',
            'company_phone_number' => 'required|regex:/^[0-9]+$/i',
            'featured_image' => 'required',
            'industry_id' => 'required',
            'owner_id' => 'required',
            'address' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required'
        ];
    }

    public function messages()
    {
        return [
            // 'company_email.regex' => 'Enter valid email',
            'company_email.unique' => 'Email is already taken. Try Different',
            'company_phone_number.regex' => 'Invalid Number',
            'featured_image.required' => 'Input image here'
        ];
    }
}
