<?php

namespace App\Http\Requests\Backend\CompanyProfile;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyProfileRequest extends FormRequest
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
            'company_email' => 'required|unique:company_profiles,company_email',
            'company_phone_number' => 'required',
            'featured_image' => 'required',
            'industry_id' => 'required',
            'owner_id' => 'required',
            'address' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required'
        ];
    }
}
