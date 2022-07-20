<?php

namespace App\Http\Controllers\Admin\Group;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Group\NewAdminRequest;
use App\Mail\Admin\NewAdminLinkMail;
use App\Models\Admin;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class NewAdminController extends Controller
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
     * 管理者新規作成画面表示
     */
    public function showNewAdminForm()
    {
        $groups = Auth::user()->groups;

        return view('admin.groups.new_admin_form', compact('groups'));
    }

    /**
     * 管理者新規作成
     */
    public function newAdmin(NewAdminRequest $request)
    {
        // 新規作成
        // パスワードの自動生成
        $password = Str::random(32);

        $new_admin = Admin::create([
            'admin_name' => $request->admin_name,
            'last_name'  => $request->last_name,
            'first_name' => $request->first_name,
            'email'      => $request->email,
            'password'   => Hash::make($password),
        ]);

        // 新規管理者とグループの関連付け
        $new_admin->groups()->attach($request->group_id);

        // メール送信（パスワードリセット）
        $group = Group::find($request->group_id);
        Mail::send(new NewAdminLinkMail($group, $new_admin, $password));

        return back();
    }
}