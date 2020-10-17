<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Helpers\Auth\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Access\User\User;
use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Utilities\NotificationIos;
use Illuminate\Support\Facades\Session;
use App\Helpers\Frontend\Auth\Socialite;
use App\Http\Utilities\PushNotification;
use App\Events\Frontend\Auth\UserLoggedIn;
use App\Events\Frontend\Auth\UserLoggedOut;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Facades\Auth;

/**
 * Class LoginController.
 */
class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * @var \App\Http\Utilities\PushNotification
     */
    protected $notification;

    /**
     * @param NotificationIos $notification
     */
    public function __construct(PushNotification $notification)
    {
        $this->notification = $notification;
    }

    /**
     * Where to redirect users after login.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (access()->allow('view-backend')) {
            return route('admin.dashboard');
        }

        return route('frontend.participateMbaye');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('frontend.auth.login')
            ->withSocialiteLinks((new Socialite())->getSocialLinks());
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.

        if (method_exists($this, 'hasTooManyLoginAttempts') && $this->hasTooManyLoginAttempts($request)) 
        {
            Log::debug('has too many login');
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        if ($this->attemptLogin($request)) 
        {
            Log::debug('attempt login');
            return $this->sendLoginResponse($request);
            
        }
        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        Log::debug('increment attempts');
        $this->incrementLoginAttempts($request);
        // dd($this->sendFailedLoginResponse($request));
        // dd($this->sendFailedLoginResponse($request));

        Log::debug($this->sendFailedLoginResponse($request));
        return $this->sendFailedLoginResponse($request);
        // return  $this->sendFailedLoginResponse($request);
             
        // dd( $this->incrementLoginAttempts($request));
        // return redirect()->back()->withErrors('You did not sign-in correctly or your account is temporarily disabled');
    }
     protected function sendFailedLoginResponse(Request $request)
    {
        return response()->json([
            $this->username() => [trans('auth.failed')],
            'redirectPath' => 'login',
            'title'=>'Something Went Wrong!',
            'message'=>'Email or password is incorrect',
            'status'=>'failed'
        ]);
        
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
        // dd($return);        
    }


    /**
     * @param Request $request
     * @param $user
     *
     * @throws GeneralException
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $user)
    {
        // dd($user);
        Log::debug($user);
       /**
        * Checking user account is verified or not, if not redirect back
        */
        if ($user->confirmed == 0) {
            
            access()->logout();
            // throw new GeneralException('This account is not yet verified. Please check your email to verify your account.');
            // return redirect()->back()->withErrors('This account is not yet verified. Please check your email to verify your account.');
            // return redirect()->back()->with('error', 'This account is not yet verified. Please check your email to verify your account.');
            // commented by nouman
            // Session::flash('message', 'This account is not yet verified. Please check your email to verify your account.!'); 
            // Session::flash('alert-class', 'alert-danger');
            // commented by nouman

            return response()->json([
                'redirectPath' => 'login',
                'redirect'=>'no',
                'title'=>'Not Confirmed',
                'message'=>trans('exceptions.frontend.auth.confirmation.confirm'),
                'status'=>'notConfirmed'
            ]); 
        }

        /*
         * Check to see if the users account is confirmed and active
         */
        if ($user->status == 0 && $user->confirmed == 1) 
        {
            access()->logout();

            // throw new GeneralException(trans('exceptions.frontend.auth.confirmation.resend', ['user_id' => $user->id]), true);
            
            return response()->json([
                'redirectPath' => 'login',
                'redirect'=>'no',
                'title'=>'Deactive',
                'message'=> trans('exceptions.frontend.auth.deactivated'),
                'status'=>'deActive'
            ]);

        }

        /*
         * Check to see if the users account is active and not confirmed
         */
        if ($user->status == 1 && $user->confirmed == 0) 
        {
            access()->logout();
            // Auth::logout();

            // throw new GeneralException(trans('exceptions.frontend.auth.confirmation.resend', ['user_id' => $user->id]), true);
            
            return response()->json([
                'redirectPath' => 'login',
                'redirect'=>'no',
                'title'=>'Not Confirm',
                'message'=> trans('exceptions.frontend.auth.confirmation.resend'),
                'status'=>'notConfirmed'
            ]);

        }

        // dd("sd".$user->already_login);
        if ($user->already_login==0) 
        {
            $affectedRows = User::where('id', '=',$user->id)->update(array('already_login' => 1));
             event(new UserLoggedIn($user));
           
            // return  redirect()->route('frontend.initial-agreement');
            // return route('frontend.dashboard');
            return response()->json([
                'redirectPath' => 'initial-agreement',
                'title'=>'Success',
                'message'=>'Welcome to Mbaye',
                'status'=>'success'
            ]);
           
        }
        else{
            // return redirect()->intended($this->redirectPath());
            event(new UserLoggedIn($user));
            return response()->json([
                'redirectPath' => $this->redirectPath(),
                'title'=>'Success',
                'message'=>'Welcome to Mbaye',
                'status'=>'success'
            ]);
            // return  redirect()->route('frontend.participateMbaye'); 
        }
        /*
        // Push notification implementation

        $deviceToken    =   "3694d3a6b7258dd6653c6ec0d8488e5fc38577a164af4365b12e5fc0106cc705";
        $message        =   "Testing from php department";
        $sendOption     =   array('Type' => 'Quote');
        $this->notification->_pushNotification($message, 'ios', $deviceToken);
        */
        // $passportToken = $user->createToken('API Access Token');
        // // Save generated token
        // $passportToken->token->save();
        // $token = $passportToken->accessToken;
        // dd($token);
        // return redirect()->intended($this->redirectPath());
    }
    /**
     * Redirect the user after determining they are locked out.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        return response()->json([
            'message' => Lang::get('auth.throttle', ['seconds' => $seconds,'minutes' => ceil($seconds / 60)]),
            'code'=>429,
            'title'=>'Access Resticted',
            'status'=>'moreAttempts'
        ]);
        
    }

    /**
     * Log the user out of the application.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        /*
         * Boilerplate needed logic
         */

        /*
         * Remove the socialite session variable if exists
         */
        if (app('session')->has(config('access.socialite_session_name'))) {
            app('session')->forget(config('access.socialite_session_name'));
        }

        /*
         * Remove any session data from backend
         */
        app()->make(Auth::class)->flushTempSession();

        /*
         * Fire event, Log out user, Redirect
         */
        event(new UserLoggedOut($this->guard()->user()));

        /*
         * Laravel specific logic
         */
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect('/');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logoutAs()
    {
        //If for some reason route is getting hit without someone already logged in
        if (!access()->user()) {
            return redirect()->route('frontend.auth.login');
        }

        //If admin id is set, relogin
        if (session()->has('admin_user_id') && session()->has('temp_user_id')) {
            //Save admin id
            $admin_id = session()->get('admin_user_id');

            app()->make(Auth::class)->flushTempSession();

            //Re-login admin
            access()->loginUsingId((int) $admin_id);

            //Redirect to backend user page
            return redirect()->route('admin.access.user.index');
        } else {
            app()->make(Auth::class)->flushTempSession();

            //Otherwise logout and redirect to login
            access()->logout();

            return redirect()->route('frontend.auth.login');
        }
    }

    
}
