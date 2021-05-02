<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\St_profile;
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
            'nickname' => ['required', 'string', 'max:255'],
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
            'status' => config('const.USER_STATUS.PRE_REGISTER')
        ]);

        //Mail::to($st->email)->send(new OfferMail($offer));
        Mail::send('auth.email.pre_register', ['token' => $user['email_verify_token']], function ($message) use ($data){
          $message->subject('仮登録が完了しました');
          $message->from('mensetsu_zukan@example.com');
          $message->to($data['email']);
        });

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

     public function showForm2(Request $request)
     {
         $request->validate([
           'gender' => 'required|digits_between:1,2',
           'name' => 'required|string',
           'kana_name' => 'required|string',
           'nickname' => 'required|string',
         ]);

         $input = $request->all();

         //=====部分処理====================================
     /*
         $validator = Validator::make($input, $this->validator);
         if($validator->fails()){
           return redirect()->action("Hr_OfferController@show")
             ->withInput()
             ->withErrors($validator);
         }
     */
         //================================================

         //セッションに書き込む
         $request->session()->put("register_input", $input);

         return view('auth.main.register2');
     }

     public function showForm3(Request $request)
     {

         $input = $request->all();

         //=====部分処理====================================
     /*
         $validator = Validator::make($input, $this->validator);
         if($validator->fails()){
           return redirect()->action("Hr_OfferController@show")
             ->withInput()
             ->withErrors($validator);
         }
     */
         //================================================

         //セッションに書き込む
         $request->session()->put("register2_input", $input);

         return view('auth.main.register3');
     }

     public function showForm4(Request $request)
     {
         $input = $request->all();

         //=====部分処理====================================
     /*
         $validator = Validator::make($input, $this->validator);
         if($validator->fails()){
           return redirect()->action("Hr_OfferController@show")
             ->withInput()
             ->withErrors($validator);
         }
     */
         //================================================

         //セッションに書き込む
         $request->session()->put("register3_input", $input);

         return view('auth.main.register4');
     }

     public function post(Request $request)
     {
       $input = $request->all();

/*
       if($input['plan'] == 'audience'){
         return redirect()->action("Auth\RegisterController@credit");
       }
*/
       //=====部分処理====================================
   /*
       $validator = Validator::make($input, $this->validator);
       if($validator->fails()){
         return redirect()->action("Hr_OfferController@show")
           ->withInput()
           ->withErrors($validator);
       }
   */
       //================================================

       //セッションに書き込む
       $request->session()->put("register4_input", $input);

       return redirect()->action("Auth\RegisterController@confirm");
     }

     function confirm(Request $request){
       //セッションから値を取り出す
       $register_input = $request->session()->get("register_input");
       $register2_input = $request->session()->get("register2_input");
       $register3_input = $request->session()->get("register3_input");
       $register4_input = $request->session()->get("register4_input");

       //セッションに値が無い時はホームに戻る
       if(!($register_input && $register2_input && $register3_input && $register4_input)){
         return redirect()->route('home');
       }
       return view('auth.main.register_comfirm', compact('register_input', 'register2_input', 'register3_input'));
     }

     public function mainRegister(Request $request)
     {
       //セッションから値を取り出す
       $register_input = $request->session()->get("register_input");
       $register2_input = $request->session()->get("register2_input");
       $register3_input = $request->session()->get("register3_input");
       $register4_input = $request->session()->get("register4_input");

       //戻るボタンが押された時
       if($request->has("back")){
         return redirect()->route('home');
       }

       //セッションに値が無い時はフォームに戻る
       if(!($register_input && $register2_input)){
         return redirect()->route('home');
       }

       //=====処理内容====================================
       $user = User::where('email_verify_token', $register_input['email_verify_token'])->first();
       $user->name = $register_input['name'];
       $user->kana_name = $register_input['kana_name'];
       $user->nickname = $register_input['nickname'];
       $user->university_id = 1;
       $user->graduate_year = $register2_input['graduate_year'];
       $user->gender = $register_input['gender'];
       $user->status = config('const.USER_STATUS.UNAVAILABLE');
       $user->company_type = $register3_input['company_type'];
       $user->industry_id = 1;
       $user->jobtype = $register3_input['jobtype'];

       if($register4_input['plan'] == '投稿者プラン'){
         $user->plan = "contributor";
       } else{
         $user->plan = "audience";
       }
       if(!is_null($register3_input['workplace'])){
         $user->workplace = $register3_input['workplace'];
       }
       if(!is_null($register3_input['start_time'])){
         $user->start_time = $register3_input['start_time'];
       }

       $user->save();

       //================================================

       //セッションを空にする
       $request->session()->forget("register_input");
       $request->session()->forget("register2_input");
       $request->session()->forget("register3_input");
       $request->session()->forget("register4_input");

       return view("auth.main.registered");
     }

     function credit(Request $request){
       return view('auth.main.register_credit');
     }
}
