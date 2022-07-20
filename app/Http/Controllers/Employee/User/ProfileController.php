<?php

namespace App\Http\Controllers\Employee\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showProfile($user_name)
    {
        $employee = Auth::user();

        // 本人でなければリダイレクト
        if ($employee->user_name != $user_name) {
            return redirect()->route('admin.home');
        }

        return view('employee.users.profile', compact('employee'));
    }
}