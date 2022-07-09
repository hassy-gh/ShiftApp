<?php

namespace App\Http\Controllers\Admin\Group;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Group\RegisterRequest;
use App\Models\Group;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
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
     * グループ作成フォーム画面の表示
     */
    public function showRegisterForm()
    {
        return view('admin.groups.register_form');
    }

    /**
     * グループ作成
     */
    public function register(RegisterRequest $request)
    {
        // ------ TODO phone_numberの形式整える ------
        $group = Group::create([
            'group_name'   => $request->group_name,
            'name'         => $request->name,
            'phone_number' => $request->phone_number,
            'password'     => Hash::make($request->password),
        ]);

        return redirect()->route('admin.group.profile', $group->id);
    }
}