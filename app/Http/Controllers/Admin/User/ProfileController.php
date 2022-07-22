<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\EditProfileRequest;
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
        $this->middleware('auth:admin');
    }

    /**
     * プロフィール画面表示
     */
    public function showProfile($admin_name)
    {
        $admin = Auth::user();
        $groups = $admin->groups;

        // 本人でなければリダイレクト
        if ($admin->admin_name != $admin_name) {
            return redirect()->route('admin.home');
        }

        return view('admin.users.profile', compact(['admin', 'groups']));
    }

    /**
     * プロフィール編集画面表示
     */
    public function showProfileEditForm($admin_name)
    {
        $admin = Auth::user();

        // 本人でなければリダイレクト
        if ($admin->admin_name != $admin_name) {
            return redirect()->route('admin.home');
        }

        return view('admin.users.edit', compact('admin'));
    }

    /**
     * プロフィール編集
     */
    public function editProfile(EditProfileRequest $request, $admin_name)
    {
        $admin = Auth::user();

        // 本人でなければリダイレクト
        if ($admin->admin_name != $admin_name) {
            return redirect()->route('admin.home');
        }

        // データの更新
        $admin->admin_name  = $request->admin_name;
        $admin->last_name  = $request->last_name;
        $admin->first_name = $request->first_name;
        $admin->email      = $request->email;
        if (!is_null($request->password)) {
            $admin->password = Hash::make($request->password);
        }

        // データの保存
        $admin->save();

        return redirect()
            ->route('admin.user.profile', $admin->admin_name);
    }
}