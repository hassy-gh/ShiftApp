<?php

namespace App\Http\Controllers\Employee\Group;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Employee\Group\JoinRequest;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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
        $employee = Auth::user();
        $group = Group::where('group_name', $request->group_name)->first();

        // グループが存在する場合かつパスワードが一致する場合
        // ------ TODO 従業員が既に同一グループに参加している場合はエラー ------
        if (isset($group) && password_verify($request->password, $group->password)) {
            if ($employee->groups()->find($group->id)->get()) {
                return $this->sendJoinedResponse($request);
            }
            $group->users()->attach($employee->id);

            return redirect()->route('home');
        }

        return $this->sendFailedJoinResponse($request);
    }

    /**
     * グループ参加済みのとき
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendJoinedResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'group_name' => [trans('join.joined')],
        ]);
    }

    /**
     * グループの認証に失敗したとき
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedJoinResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'group_name' => [trans('join.failed')],
        ]);
    }
}