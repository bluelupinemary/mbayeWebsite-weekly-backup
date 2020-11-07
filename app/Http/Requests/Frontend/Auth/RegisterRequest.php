<?php

namespace App\Http\Requests\Frontend\Auth;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

/**
 * Class RegisterRequest.
 */
class RegisterRequest extends Request
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
        // echo "<pre>";print_r($_POST);die();        
        return [
            'first_name'           => 'required|max:255',
            'last_name'            => 'required|max:255',
            'dob'                  => 'date_format:Y-m-d|before:today',
            'gender'               => 'required',
            'age'                  => '',
            'occupation'           => 'required',
            'email'                => ['required', 'email', 'max:255', Rule::unique('users')],
            'photo'                => 'required',
            'password'             => 'required|min:8|regex:"^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$"',
           // 'is_term_accept'       => 'required',
            'g-recaptcha-response' => 'required_if:captcha_status,true|captcha',
        ];

    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'g-recaptcha-response.required_if' => trans('validation.required', ['attribute' => 'captcha']),
            'password.regex'                   => 'Password must contain at least one number and both uppercase and lowercase letters.',
            'is_term_accept.required'          => 'Pleasse accept terms & agreement to continue',
        ];
    }

    // CUSTOM VALIDATION FOR SPOONSOR NAME AND SPONSOR EMAIL
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
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
