<?php

namespace App\Http\Requests\Frontend\User;

use App\Http\Requests\Request;

/**
 * Class ChangePasswordRequest.
 */
class ChangePasswordRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->user()->canChangePassword();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => 'required',
            'password'     => 'required|min:8|confirmed|regex:"^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$"',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'password.regex' => ' The password must contain at least one number and both uppercase and lowercase letters.',
            'password.required' => ' New password is required.',
            'password.min' => ' The password must be at least 8 characters.'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->has('old_password') && !Hash::check($this->old_password, \Auth::user()->password)) {
                $validator->errors()->add('old_password', ' Old password is not valid.');
            }
        });
    }
}
