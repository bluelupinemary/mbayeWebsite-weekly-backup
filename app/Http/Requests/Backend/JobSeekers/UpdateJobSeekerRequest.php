<?php

namespace App\Http\Requests\Backend\JobSeekers;

use App\Http\Requests\Request;

/**
 * Class UpdateJobSeekersRequest.
 */
class UpdateJobSeekersRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-profile');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'name'              => 'required|max:191|unique:blogs,name,'.Request::get('blog_id'),
            'name'              => 'required|max:80',
            'featured_image'    => 'image|mimes:jpeg,png,jpg|max:5242880',
            // 'publish_datetime'  => 'required|date',
            'content'           => 'required',
            'tags'              => 'required',
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
            'name.required' => 'JobSeeker Title is empty.',
            'name.max'      => 'JobSeeker Title may not be greater than 80 characters.',
            'name.unique'   => 'JobSeeker Title already exist.',
            'content.required' => 'JobSeeker Content is empty.',
            'tags.required' => 'No selected tag.'
        ];
    }
}
