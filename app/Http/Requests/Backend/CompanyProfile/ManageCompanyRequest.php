<?php

namespace App\Http\Requests\Backend\CompanyProfile;

use App\Http\Requests\Request;

/**
 * Class ManageJobSeekersRequest.
 */
class ManageCompanyRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('view-company');
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
