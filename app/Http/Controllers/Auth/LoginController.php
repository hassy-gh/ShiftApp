<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * メールアドレスまたはShiftAppIDで認証
     */
    protected function username()
    {
        return 'email_or_user_name';
    }

    /**
     * メールアドレスまたはShiftAppIDで認証
     */
    protected function attemptLogin(Request $request)
    {
        $email_or_user_name = $request->input($this->username());
        $password = $request->input('password');

        if (filter_var($email_or_user_name, \FILTER_VALIDATE_EMAIL)) {
            $credentials = ['email' => $email_or_user_name, 'password' => $password];
        } else {
            $credentials = ['user_name' => $email_or_user_name, 'password' => $password];
        }
        return $this->guard()->attempt($credentials, $request->boolean('remember'));
    }
}