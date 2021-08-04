<?php
namespace App\Notifications;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Notifications\Messages\MailMessage;

class HrPasswordResetNotification extends ResetPasswordNotification
{
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        if (static::$createUrlCallback) {
            $url = call_user_func(static::$createUrlCallback, $notifiable, $this->token);
        } else {
            $url = url(route('hr.password.reset', [
                'token' => $this->token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false));
        }

        return $this->buildMailMessage($url);
    }

    protected function buildMailMessage($url)
    {
        return (new MailMessage)
            ->subject("パスワードの再設定を行ってください。")
            ->line('以下のボタンからパスワード再設定ページに遷移します。')
            ->action('Reset Password', $url)
            ->line('上記のリンクの有効期限は60分です。')
            ->line('もし、パスワード再設定の操作をしていない場合は、このメールを無視してください。');
    }


}