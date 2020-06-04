<?php

namespace App\Http\Requests\Backend\Blogs;

use App\Http\Requests\Request;

/**
 * Class StoreBlogsRequest.
 */
class StoreBlogsRequest extends Request
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
            'name'              => 'required|max:191',
            'featured_image'    => 'image|mimes:jpeg,png,jpg|max:5242880',
            // 'publish_datetime'  => 'required|date',
            'content'           => 'required',
            'tags'              => 'required'
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
            'name.max'      => 'Blog Title may not be greater than 191 characters.',
            'name.unique'   => 'Blog Title already exist.',
            'content.required' => 'Blog Content is empty.',
            'tags.required' => 'No selected tag.'
        ];
    }
}
