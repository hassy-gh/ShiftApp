<?php

namespace App\Http\Controllers\Employee\Group;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Employee\Group\JoinRequest;

class JoinController extends Controller
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
     * グループ参加フォーム画面の表示
     */
    public function showJoinForm()
    {
        return view('employee.groups.join_form');
    }

    /**
     * グループ参加
     */
    public function join(JoinRequest $request)
    {
        # code...
    }
}