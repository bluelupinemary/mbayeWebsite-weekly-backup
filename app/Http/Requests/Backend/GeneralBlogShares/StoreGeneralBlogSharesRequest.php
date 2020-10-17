<?php

namespace App\Http\Requests\Backend\GeneralBlogShares;

use App\Http\Requests\Request;

/**
 * Class CreateBlogsRequest.
 */
class StoreGeneralBlogSharesRequest extends Request
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
            'share_caption'        => 'required',
            'blog_id'              => 'required',
            'share_as_permanent'   => 'required',
            'tag_ids'              => 'required_if:share_as_permanent,"1"',
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
            'share_caption.required' => 'Caption is empty.',
            'share_as_permanent.required' => 'Status is empty.',
            'tag_ids.required_if' => 'No selected tags.'
        ];
    }
}
