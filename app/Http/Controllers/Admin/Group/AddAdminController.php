<?php

namespace App\Http\Controllers\Admin\Group;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Group\AddAdminRequest;
use App\Mail\Admin\AddAdminLinkMail;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        return view('admin.group.add_admin_form');
    }

    /**
     * 管理者追加メール送信
     */
    public function sendAddAdminLinkEmail(AddAdminRequest $request)
    {
        $email = $request->email;
        // メールアドレスが存在しない場合
        if (!Admin::where('email', $email)->exists()) {
            return back()
                ->withInput($email)
                ->withErrors(['email' => trans('passwords.user')]);
        }

        // URLの生成
        $temporary_signed_url = $this->generateTemporarySignedURL($email);

        // メールを送信
        Mail::send(new AddAdminLinkMail($email, $temporary_signed_url));

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

        // ------ TODO Groupとの連携 ------
    }

    /**
     * 有効期限・署名付きのURL生成
     */
    protected function generateTemporarySignedURL($email)
    {
        // 有効期限24時間
        $expire = Carbon::now()->addHours(24);

        $temporary_signed_url = URL::temporarySignedRoute(
            'admin.group.add-admin',
            $expire,
            [
                'email' => $email,
            ],
        );

        return $temporary_signed_url;
    }
}