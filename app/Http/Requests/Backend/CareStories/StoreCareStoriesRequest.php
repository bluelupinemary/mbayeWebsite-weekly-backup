<?php

namespace App\Http\Requests\Backend\CareStories;

use App\Http\Requests\Request;

/**
 * Class StoreCareStoriesRequest.
*/
class StoreCareStoriesRequest extends Request
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
            // 'featured_image'    => 'image|mimes:jpeg,png,jpg|max:5242880',
            'panel_id'          => 'required',
            // 'publish_datetime'  => 'required|date',
            'content'           => 'required',
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
            'name.required' => 'Title is empty.',
            'name.max'      => 'Title may not be greater than 80 characters.',
            // 'name.unique'   => 'Blog Title already exist.',
            'content.required' => 'Content is empty.',
            'panel_id.required' => 'No selected panel number.'
        ];
    }
}
