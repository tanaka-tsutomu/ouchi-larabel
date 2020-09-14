<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword;

class PasswordResetNotification extends ResetPassword
{
    use Queueable;

   //追加
public $token;
protected $title = 'パスワードリセット 通知';

//変更
public function __construct($token)
{
    $this->token = $token;
}

public function toMail($notifiable)
{
    return (new MailMessage)
        ->subject($this->title)
        ->view('email.password_reset',
            [
                'reset_url' => url('password/reset', $this->token),
            ]);
}
}