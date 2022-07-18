<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AddAdminLinkMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($group, $email, $temporary_signed_url)
    {
        $this->group = $group;
        $this->email = $email;
        $this->temporary_signed_url = $temporary_signed_url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->email)
            ->subject('新規管理者登録のお知らせ')
            ->view('admin.groups.mail.add_admin_mail')
            ->with([
                'group' => $this->group,
                'url'   => $this->temporary_signed_url,
            ]);
    }
}