<?php

namespace App\Http\Controllers\Employee\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\User\EditProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    /**
     * プロフィール画面表示
     */
    public function showProfile($user_name)
    {
        $employee = Auth::user();
        $groups = $employee->groups;

        // 本人でなければリダイレクト
        if ($employee->user_name != $user_name) {
            return redirect()->route('home');
        }

        return view('employee.users.profile', compact(['employee', 'groups']));
    }

    /**
     * プロフィール編集画面表示
     */
    public function showProfileEditForm($user_name)
    {
        $employee = Auth::user();

        // 本人でなければリダイレクト
        if ($employee->user_name != $user_name) {
            return redirect()->route('home');
        }

        return view('employee.users.edit', compact('employee'));
    }

    /**
     * プロフィール編集
     */
    public function editProfile(EditProfileRequest $request, $user_name)
    {
        $employee = Auth::user();

        // 本人でなければリダイレクト
        if ($employee->user_name != $user_name) {
            return redirect()->route('home');
        }

        // データの更新
        $employee->user_name  = $request->user_name;
        $employee->last_name  = $request->last_name;
        $employee->first_name = $request->first_name;
        $employee->email      = $request->email;
        if (!is_null($request->password)) {
            $employee->password = Hash::make($request->password);
        }

        // データの保存
        $employee->save();

        return redirect()
            ->route('employee.user.profile', $employee->user_name);
    }
}