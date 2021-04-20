<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerification;
use Carbon\Carbon;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'email_verify_token' => base64_encode($data['email']),
            'status' => 0,
        ]);

        //Mail::to($st->email)->send(new OfferMail($offer));
        Mail::send('auth.email.pre_register', ['token' => $user['email_verify_token']], function ($message) {
          $message->subject('仮登録が完了しました');
          $message->from('mensetsu_zukan@example.com');
          $message->to('yuu.yoshi12@outlook.com');
        });
        /*

        $email = new EmailVerification($user);
        Mail::to($user->email)->send($email);

        */
        return $user;
    }

    public function register(Request $request)
    {
      event(new Registered($user = $this->create( $request->all() )));

      return view('auth.registered');
    }

    public function showForm($email_token)
    {
        // 使用可能なトークンか
        if ( !User::where('email_verify_token',$email_token)->exists() )
        {
            return view('auth.main.register')->with('message', '無効なトークンです。');
        } else {
            $user = User::where('email_verify_token', $email_token)->first();
            // 本登録済みユーザーか
            if ($user->status == config('const.USER_STATUS.REGISTER')) //REGISTER=1
            {
                logger("status". $user->status );
                return view('auth.main.register')->with('message', 'すでに本登録されています。ログインして利用してください。');
            }
            // ユーザーステータス更新
            $user->status = config('const.USER_STATUS.MAIL_AUTHED');
            $user->email_verified_at = Carbon::now('asia/Tokyo');
            if($user->save()) {
                return view('auth.main.register', compact('email_token'));
            } else{
                return view('auth.main.register')->with('message', 'メール認証に失敗しました。再度、メールからリンクをクリックしてください。');
            }
        }
    }

   public function mainCheck(Request $request)
   {
     $request->validate([
       'name' => 'required|string',
       'username' => 'required|string',
       'graduate_year' => 'required|numeric',
     ]);

     //データ保持用
     $email_token = $request->token;

     $user = new User();
     $user->name = $request->name;
     $user->username = $request->username;
     $user->graduate_year = $request->graduate_year;

     return view('auth.main.register_check', compact('user','email_token'));
   }

   public function mainRegister(Request $request)
   {

     echo $request->token;

     $user = User::where('email_verify_token', $request->token)->first();
     $user->status = config('const.USER_STATUS.REGISTER');
     $user->name = $request->name;

     $user->username = $request->username;
     $user->graduate_year = $request->graduate_year;
     $user->save();

     return view('auth.main.registered');
   }

}
