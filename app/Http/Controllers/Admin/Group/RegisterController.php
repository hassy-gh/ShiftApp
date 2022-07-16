<?php

namespace App\Http\Controllers\Admin\Group;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Group\RegisterRequest;
use App\Models\Group;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
        // phone_numberがハイフンを含んでいる場合の取り除く
        $phone_number = $request->phone_number;
        if (preg_match('/-/', $phone_number)) {
            $phone_number = str_replace('-', '', $phone_number);
        }

        $group = Group::create([
            'group_name'   => $request->group_name,
            'name'         => $request->name,
            'phone_number' => $phone_number,
            'password'     => Hash::make($request->password),
        ]);

        Auth::user()->groups()->attach($group->id);

        return redirect()->route('admin.group.profile', $group->id);
    }
}