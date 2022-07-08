<?php

namespace App\Http\Controllers\Admin\Group;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Group\RegisterRequest;

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
        # code...
    }
}