<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Repositories\Frontend\Access\User\UserRepository;
use Illuminate\Http\Request;
/**
 * Class ForgotPasswordController.
 */
class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;
    protected $user;


    public function __construct(UserRepository $user)
    { 
        $this->user = $user;
        $this->middleware('guest');
    }


    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    { 
       return view('frontend.auth.passwords.email');
     
    }

    protected function validateEmail(Request $request)
    { 
        $this->validate($request, ['email' => 'required|email'], [
            'email.required' => 'The email field is required',
            'email.email' => 'Please insert a valid email.',
        ]);
    }

    public function rules()
    {
        return [
         
            'email' => 'required|email',
           
        ];
    }

}
