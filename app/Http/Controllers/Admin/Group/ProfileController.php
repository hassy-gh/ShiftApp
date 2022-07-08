<?php

namespace App\Http\Controllers\Admin\Group;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;

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
     * グループ情報画面の表示
     */
    public function showGroupProfile($group_name)
    {
        $group = Group::where('group_name', $group_name);
        return view('admin.groups.profile', compact('group'));
    }
}