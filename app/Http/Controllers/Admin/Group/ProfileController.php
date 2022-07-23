<?php

namespace App\Http\Controllers\Admin\Group;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Group\EditProfileRequest;
use App\Models\Group;
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
        $this->middleware('join');
    }

    /**
     * プロフィール画面の表示
     */
    public function showGroupProfile($group_name)
    {
        $group = Group::where('group_name', $group_name)->first();

        return view('admin.groups.profile', compact('group'));
    }

    /**
     * プロフィール編集画面表示
     */
    public function showProfileEditForm($group_name)
    {
        $group = Group::where('group_name', $group_name)->first();

        return view('admin.groups.edit', compact('group'));
    }

    /**
     * プロフィール編集
     */
    public function editProfile(EditProfileRequest $request, $group_name)
    {
        $group = Group::where('group_name', $group_name)->first();

        // データの更新
        $group->group_name  = $request->group_name;
        $group->name  = $request->name;
        $group->phone_number = $request->phone_number;
        if (!is_null($request->password)) {
            $group->password = Hash::make($request->password);
        }

        // データの保存
        $group->save();

        return redirect()
            ->route('admin.group.profile', $group->group_name);
    }
}