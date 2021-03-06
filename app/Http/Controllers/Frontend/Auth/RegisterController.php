<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Events\Frontend\Auth\UserRegistered;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Auth\RegisterRequest;
use App\Repositories\Frontend\Access\User\UserRepository;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use DB;
use Validator;

/**
 * Class RegisterController.
 */
class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * RegisterController constructor.
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        // Where to redirect users after registering
        $this->redirectTo = route('frontend.index');

        $this->user = $user;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('frontend.auth.register');
    }

    /**
     * @param RegisterRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register(RegisterRequest $request)
    {

        if (config('access.users.confirm_email') || config('access.users.requires_approval')) {
            $user = $this->user->create($request->all());
              event(new UserRegistered($user));
            //   return redirect()->route('frontend.auth.login'); //temporary
              return redirect()->back()->with('success', 'Registration completed. We have sent an activation link to your email address . Please verify your account.');
           
        } else {
            access()->login($this->user->create($request->all()));
            event(new UserRegistered(access()->user()));
           // return redirect()->back()->with('error', '');
           
            return redirect($this->redirectPath());
        }
    }
    public function validateEmail(Request $request)
    {
        $user = DB::table('users')->where('email', $request->email)->first();
        if ($user) 
        {
            return response()->json([
                    'status' => 'exist',
                    'message' => 'email is already in database'
                ], 200); 
        }
        if($user==null)
        {
            return response()->json([
                    'status' => 'not-exist',
                    'message' => 'email is not present in database'
                ], 200);   
        }
    }
}
