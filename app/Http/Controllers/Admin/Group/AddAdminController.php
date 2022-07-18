<?php

namespace App\Http\Controllers\Admin\Group;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Group\AddAdminRequest;
use App\Mail\Admin\AddAdminLinkMail;
use App\Models\Admin;
use App\Models\Group;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

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
        $groups = Admin::find(Auth::id())->groups;
        return view('admin.groups.add_admin_form', compact('groups'));
    }

    /**
     * 管理者追加メール送信
     */
    public function sendAddAdminLinkEmail(AddAdminRequest $request)
    {
        $email = $request->email;
        $group_id = $request->group_id;
        // メールアドレスが存在しない場合
        if (!Admin::where('email', $email)->exists()) {
            return back()
                ->withInput()
                ->withErrors(['email' => trans('passwords.user')]);
        }

        // 既にグループの管理者である場合
        $added_admin = Admin::where('email', $email)->first();
        if (!is_null($added_admin->groups->find($group_id))) {
            return back()
                ->withInput()
                ->withErrors(['email' => '入力された管理者はグループに登録されています。']);
        }

        // グループが存在しない場合
        if (is_null(Group::find($group_id))) {
            return back()
                ->withInput()
                ->withErrors(['group_id' => '入力されたグループは存在しません。']);
        }

        // URLの生成
        $temporary_signed_url = $this->generateTemporarySignedURL($group_id, $email);

        // メールを送信
        $group = Group::find($group_id);
        Mail::send(new AddAdminLinkMail($group, $email, $temporary_signed_url));

        return back();
    }

    /**
     * 管理者追加
     */
    public function addAdmin(Request $request)
    {
        // URLのバリデーション
        if (!$request->hasValidSignature()) {
            return redirect()->route('admin.home');
        }

        $added_admin = Admin::where('email', $request->email)->first();
        $group = Group::find($request->group_id);

        $added_admin->groups()->attach($group->id);

        return redirect()->route('admin.group.profile', $group->id);
    }

    /**
     * 有効期限・署名付きのURL生成
     */
    protected function generateTemporarySignedURL($group_id, $email)
    {
        // 有効期限24時間
        $expire = Carbon::now()->addHours(24);

        $temporary_signed_url = URL::temporarySignedRoute(
            'admin.group.add-admin-accept',
            $expire,
            [
                'group_id' => $group_id,
                'email' => $email,
            ],
        );

        return $temporary_signed_url;
    }
}