<?php

namespace App\Http\Controllers\Admin\Group;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        # code...
    }

    /**
     * 管理者新規作成
     */
    public function newAdmin()
    {
        # code...
    }
}