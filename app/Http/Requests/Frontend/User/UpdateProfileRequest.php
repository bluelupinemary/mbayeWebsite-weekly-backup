<?php

namespace App\Http\Requests\Frontend\User;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

/**
 * Class UpdateProfileRequest.
 */
class UpdateProfileRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:255',
            'last_name'  => 'required|max:255',
            'dob'        => 'date_format:Y-m-d|before:today',
            // 'email'      => ['required', 'email', 'max:255', Rule::unique('users')],
            'gender'     => 'required',
            'age'        => '',
            'address'    => 'required',
            'country'    => 'required',
            'mobile_number' => 'required',
            'org_type'  => 'required',
            'org_name'  => 'required',
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
        // Validate password strength
        $counter = 0;
        $validator->after(function ($validator) {
            if($this->has('old_password'))
            {
                if($this->get('old_password')!='')
                {
                    if($this->has('new_password') && $this->get('new_password')!='')
                    {
                        if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/", $this->get('new_password')))
                        {
                            $validator->errors()->add('new_password', 'The password must contain at least one number and both uppercase and lowercase letters.The password must be at least 8 characters.');    
                            
                        }
                        if($this->has('c_password'))
                        {
                            if($this->get('c_password') !='')
                            {
                                if($this->get('c_password') != $this->get('new_password'))
                                {
                                    $validator->errors()->add('new_password', 'Passwords do not match!');
                                }
                            }
                            else
                            {
                                $validator->errors()->add('c_password', 'Confirm New Password');
                            }
                        }
                    }
                    else
                    {
                        $validator->errors()->add('new_password', 'Enter a Valid New Password');
                    }
                }
            }
            if($this->has('age'))
            {
                if($this->get('age') <= 18)
                {
                    if($this->get('sponsor_name') =='')
                    {
                        $validator->errors()->add('sponsor_name', 'Sponsor Name is a Required');
                    }
                    if($this->get('sponsor_email') =='')
                    {
                        $validator->errors()->add('sponsor_email', 'Sponsor Email is a Required');    
                    }
                }
            } 
        });
    }
}
