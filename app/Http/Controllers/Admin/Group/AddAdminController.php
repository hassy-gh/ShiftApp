<?php

namespace App\Http\Controllers\Admin\Group;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddAdminController extends Controller
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
     * 管理者追加画面表示
     */
    public function showAddAdminForm()
    {
        return view('admin.group.add_admin_form');
    }

    /**
     * 管理者追加
     */
    public function addAdmin()
    {
    }
}