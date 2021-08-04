<?php

namespace App\Http\Controllers\Hr\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
    public function showLinkRequestForm()
    {
        return view('hr.auth.passwords.email');
    }
    public function broker()
    {
        // 管理者ユーザ用のパスワードブローカーを指定
        return \Password::broker('hr_users');
    }
}
