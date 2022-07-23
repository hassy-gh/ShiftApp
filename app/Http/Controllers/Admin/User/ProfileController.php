<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\EditProfileRequest;
use App\Models\Admin;
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
        $this->middleware('myself')->except('showProfile');
    }

    /**
     * プロフィール画面表示
     */
    public function showProfile($admin_name)
    {
        $show_admin = Admin::where('admin_name', $admin_name)->first();   // 表示する管理者
        $auth_admin = Auth::user();                                       // 認証済み管理者
        $show_admin_groups = $show_admin->groups->pluck('id')->toArray(); // $show_adminのグループ
        $auth_admin_groups = $auth_admin->groups->pluck('id')->toArray(); // $auth_adminのグループ

        // 同じグループではないかつ本人でなければリダイレクト
        if (
            empty(array_intersect($show_admin_groups, $auth_admin_groups))
            && $auth_admin->admin_name != $admin_name
        ) {
            return redirect()->route('admin.home');
        }

        // 本人であればプロフィール編集へのリンクを表示
        if ($auth_admin->admin_name != $admin_name) {
            $admin  = $show_admin;
            $groups = $show_admin->groups;
            $auth   = false;
        } else {
            $admin  = $auth_admin;
            $groups = $auth_admin->groups;
            $auth   = true;
        }

        return view('admin.users.profile', compact(['admin', 'groups', 'auth']));
    }

    /**
     * プロフィール編集画面表示
     */
    public function showProfileEditForm($admin_name)
    {
        $admin = Auth::user();

        return view('admin.users.edit', compact('admin'));
    }

    /**
     * プロフィール編集
     */
    public function editProfile(EditProfileRequest $request, $admin_name)
    {
        $admin = Auth::user();

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