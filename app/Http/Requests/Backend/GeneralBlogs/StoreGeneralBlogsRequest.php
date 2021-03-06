<?php

namespace App\Http\Requests\Backend\GeneralBlogs;

use App\Http\Requests\Request;

/**
 * Class CreateBlogsRequest.
 */
class StoreGeneralBlogsRequest extends Request
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
            // 'name'              => 'required|max:191|unique:blogs,name',
            'name'              => 'required|max:80',
            'featured_image'    => 'image|mimes:jpeg,png,jpg|max:5242880',
            // 'publish_datetime'  => 'required|date',
            'content'           => 'required'
        ];
    }

    /**
     * Get the validation message that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Blog Title is empty.',
            'name.max'      => 'Blog Title may not be greater than 80 characters.',
            'name.unique'   => 'Blog Title already exist.',
            'content.required' => 'Blog Content is empty.'
        ];
    }
}
