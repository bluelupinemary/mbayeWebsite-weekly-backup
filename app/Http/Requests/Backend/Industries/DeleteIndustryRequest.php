<?php

namespace App\Http\Requests\Backend\Industries;

use App\Http\Requests\Request;

/**
 * Class DeleteIndustryRequest.
 */
class DeleteIndustryRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('delete-industry');
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
