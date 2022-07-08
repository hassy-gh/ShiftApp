<?php

namespace App\Http\Controllers\Employee\Group;

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
        $this->middleware('auth');
    }

    /**
     * グループ情報画面の表示
     */
    public function showGroupProfile($group_name)
    {
        $group = Group::where('group_name', $group_name);
        return view('employee.groups.profile', compact('group'));
    }
}