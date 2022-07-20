<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewAdminLinkMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($group, $new_admin, $password)
    {
        $this->group = $group;
        $this->new_admin = $new_admin;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->new_admin->email)
            ->subject('新規管理者登録のお知らせ')
            ->view('admin.groups.mail.new_admin_mail')
            ->with([
                'group'     => $this->group,
                'new_admin' => $this->new_admin,
                'password'  => $this->password,
            ]);
    }
}