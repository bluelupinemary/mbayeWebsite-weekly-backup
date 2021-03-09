<?php

namespace App\Http\Requests\Backend\Groups;

use App\Http\Requests\Request;

/**
 * Class CreateBlogsRequest.
 */
class CreateGroupsRequest extends Request
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
             'group_name' => 'required|max:80|unique:Groups,name',
        ];
    }
}
