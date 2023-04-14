<?php

namespace App\Http\Controllers\Hr\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::Hr_HOME;

    public function broker()
    {
        // 管理者ユーザ用のパスワードブローカーを指定
        return \Password::broker('hr_users');
    }

    protected function registerPasswordBroker()
    {
        $this->app->singleton('hr.auth.password', function ($app) {
            return new PasswordBrokerManager($app);
        });

        $this->app->bind('hr.auth.password.broker', function ($app) {
            return $app->make('hr.auth.password')->broker();
        });
    }

    public function showResetForm(Request $request,$token)
    {
        $email = $request->email;
        return view('hr.auth.passwords.reset', compact('token', 'email'));
    }

}
