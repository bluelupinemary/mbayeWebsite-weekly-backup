<?php

namespace App\Http\Requests\Backend\GeneralBlogs;

use App\Http\Requests\Request;

/**
 * Class DeleteBlogsRequest.
 */
class DeleteGeneralBlogsRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('delete-blog');
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
