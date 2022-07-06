<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = RouteServiceProvider::ADMIN_HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    /**
     * メールアドレスまたはAdminIDで認証
     */
    protected function username()
    {
        return 'email_or_admin_name';
    }

    /**
     * メールアドレスまたはAdminIDで認証
     */
    protected function attemptLogin(Request $request)
    {
        $email_or_admin_name = $request->input($this->username());
        $password = $request->input('password');

        if (filter_var($email_or_admin_name, \FILTER_VALIDATE_EMAIL)) {
            $credentials = ['email' => $email_or_admin_name, 'password' => $password];
        } else {
            $credentials = ['admin_name' => $email_or_admin_name, 'password' => $password];
        }
        return $this->guard()->attempt($credentials, $request->boolean('remember'));
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}