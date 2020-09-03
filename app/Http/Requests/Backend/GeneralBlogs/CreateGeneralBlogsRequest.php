<?php

namespace App\Http\Requests\Backend\GeneralBlogs;

use App\Http\Requests\Request;

/**
 * Class CreateBlogsRequest.
 */
class CreateGeneralBlogsRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-blog');
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
