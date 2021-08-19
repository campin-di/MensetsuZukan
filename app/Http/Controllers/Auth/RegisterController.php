<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Log;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerification;
use Carbon\Carbon;
use DateTime;
use App\Common\RetUniversityClass;
use App\Common\ReturnUserInformationArrayClass;

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

        // :point_down: アクセストークン
        $this->access_token = env('LINE_ACCESS_TOKEN');
        // :point_down: チャンネルシークレット
        $this->channel_secret = env('LINE_CHANNEL_SECRET');
    }

    public function redirectToProvider(Request $request) {
      $provider = $request->provider;
      return Socialite::driver($provider)->redirect();

  }

  public function handleProviderCallback(Request $request) {
      $provider = $request->provider;
      $social_user = Socialite::driver($provider)->user();
      $social_email = $social_user->getEmail();
      $social_name = $social_user->getName();
      $line_user_id = $social_user->getId();

      $auth = Auth::user();
      if($auth->line_id == "NULL"){
        $auth->email = $social_email;
        $auth->line_id = $social_user->getId();
        $auth->save();

        return view('st.auth.already.registered');
      }
      

      $user = User::where('line_id', $line_user_id);
      if(!$user->exists()) {
          $user = User::create([
              'email' => $social_email,
              'password' => Hash::make(Str::random()),
              'line_id' => $social_user->getId(),
              'status' => config('const.USER_STATUS.PRE_REGISTER'),
              'email_verify_token' => base64_encode($social_email)
          ]);

          //本会員登録リンク 送信部分
          $http_client = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($this->access_token);
          $bot         = new \LINE\LINEBot($http_client, ['channelSecret' => $this->channel_secret]);
      
          $message = url('register/verify/'. $user['email_verify_token']);
          $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($message);
          $response    = $bot->pushMessage($line_user_id, $textMessageBuilder);
      
          // 配信成功・失敗
          if ($response->isSucceeded()) {
              Log::info('Line 送信完了');
          } else {
              Log::error('投稿失敗: ' . $response->getRawBody());
          }

          return view('st/auth.registered',['email' => 'test@gmail.com']);
      }
      $user = $user->first();

      auth()->login($user->first());
      //ログインページに飛ばして、アラートで「すでに会員登録済みです」が出るように実行。
      return redirect()->action('St_HomeController@index');

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
      Mail::send('st.auth.email.pre_register', ['token' => $user['email_verify_token']], function ($message) use ($data){
        $message->subject('仮登録完了と本登録のお願い');
        $message->from('mensetsu_zukan@example.com', '面接図鑑');
        $message->to($data['email']);
      });

      return $user;
    }

    public function choice(Request $request)
    {
      //本登録完了まで達成せず1日放置したユーザーを削除する
      $targets = User::whereColumn('created_at', '=', 'updated_at')->get();
      $yesterday = new DateTime('-1 day');

      foreach($targets as $target){
        $targetDate = new DateTime($target->created_at);
        if($targetDate->diff($yesterday)->invert == 0){
          $target->delete();
        }
      }

      return view('st/auth.choice');
    }

    public function register(Request $request)
    {
      event(new Registered($user = $this->create( $request->all() )));

      $email = $user['email'];

      return view('st/auth.registered', compact('email'));
    }

    public function showForm($email_token)
    {
      // 使用可能なトークンか
      if ( !User::where('email_verify_token',$email_token)->exists() )
      {
          return view('st/auth.main.register')->with('message', '無効なトークンです。');
      } else {
          $user = User::where('email_verify_token', $email_token)->first();
          // 本登録済みユーザーか
          if ($user->status != config('const.USER_STATUS.PRE_REGISTER') && $user->status != config('const.USER_STATUS.MAIL_AUTHED'))
          {
              logger("status". $user->status );
              return view('st/auth.main.register')->with('message', 'すでに本登録されています。ログインして利用してください。');
          }
          // ユーザーステータス更新
          $user->status = config('const.USER_STATUS.MAIL_AUTHED');
          $user->email_verified_at = Carbon::now('asia/Tokyo');
          if($user->save()) {
            $channelArray = ReturnUserInformationArrayClass::returnChannelArray();
            return view('st/auth.main.register', compact('email_token', 'channelArray'));
          } else{
            return view('st/auth.main.register')->with('message', 'メール認証に失敗しました。再度、メールからリンクをクリックしてください。');
          }
      }
    }

     public function showForm2(Request $request)
     {
      $input = $request->all();

      //== Validator処理 ======================================================
      $rules = [
        //全角カナだけ通す正規表現：regex:/^[^\x01-\x7E\x{FF61}-\x{FF9F}]+$/u'
        'gender' => 'required|digits_between:1,2',
        'lastname' => 'required|string|regex:/^[^\x01-\x7E\x{FF61}-\x{FF9F}]+$/u',
        'firstname' => 'required|string|regex:/^[^\x01-\x7E\x{FF61}-\x{FF9F}]+$/u',
        'kana_lastname' => 'required|string|regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u',
        'kana_firstname' => 'required|string|regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u',
        'nickname' => 'required|string|regex:/^[^\x01-\x7E\x{FF61}-\x{FF9F}]+$/u',
      ];
      $messages = [
        'gender.required' => '性別を選択してください。',
        'lastname.required' => '「性」を入力してください。',
        'lastname.regex' => '日本語で入力してください。',
        'lastname.string' => '文字列を入力してください。',
        'firstname.required' => '「名」を入力してください。',
        'firstname.regex' => '日本語で入力してください。',
        'firstname.string' => '文字列を入力してください。',
        'kana_lastname.required' => 'フリガナを入力してください。',
        'kana_lastname.string' => '文字列を入力してください。',
        'kana_lastname.regex' => 'カタカナで入力してください。',
        'kana_firstname.required' => 'フリガナを入力してください。',
        'kana_firstname.string' => '文字列を入力してください。',
        'kana_firstname.regex' => 'カタカナで入力してください。',
        'nickname.required' => 'ニックネームを入力してください。',
        'nickname.string' => '文字列を入力してください。',
        'nickname.regex' => '日本語で入力してください。',
      ];
      $validator = Validator::make($input, $rules, $messages);
      $validated = $validator->validate(); //元のページにリダイレクトしてくれる。
      //=======================================================================

      //セッションに書き込む
      $request->session()->put("register_input", $input);

      return view('st/auth.main.register2');
     }

     public function redirectShowForm2()
     {
       return view('st/auth.main.register2');
     }

     public function showForm3(Request $request)
     {
       $input = $request->all();

       //== Validator処理 ======================================================
       $rules = [
         'university' => 'required|string|ends_with:大学',
         'faculty' => 'required|string|ends_with:学部,学群,学域',
         'department' => 'required|string|ends_with:学科,コース,過程,類',
         'graduate_year' => 'required',
       ];
       $messages = [
         'university.required' => '大学名を入力してください。',
         'university.string' => '日本語で入力してください。',
         'university.ends_with' => '〇〇大学の形式で入力してください。',
         'faculty.required' => '学部名を入力してください。',
         'faculty.string' => '日本語で入力してください。',
         'faculty.ends_with' => '〇〇学部/学群/学域の形式で入力してください。',
         'department.required' => '学科名を入力してください。',
         'department.string' => '日本語で入力してください。',
         'department.ends_with' => '〇〇学科/コース/類/過程の形式で入力してください。',
         'graduate_year.required' => '卒業年度を選択してください。',
       ];
       $validator = Validator::make($input, $rules, $messages);
       $validated = $validator->validate(); //元のページにリダイレクトしてくれる。
       //=======================================================================

       //セッションに書き込む
       $request->session()->put("register2_input", $input);

       $companyTypeArray = ReturnUserInformationArrayClass::returnCompanyTypeArray();
       $industryArray = ReturnUserInformationArrayClass::returnIndustry();
       $jobtypeArray = ReturnUserInformationArrayClass::returnJobtypeArray();
       $prefecturesArray = ReturnUserInformationArrayClass::returnPrefectures();
       $startTimeArray = ReturnUserInformationArrayClass::returnStartTimeArray();
       $toeicArray = ReturnUserInformationArrayClass::returnToeicArray();
       $englishLevelArray = ReturnUserInformationArrayClass::returnEnglishLevelArray();

       return view('st/auth.main.register3',compact('companyTypeArray', 'industryArray', 'jobtypeArray', 'prefecturesArray', 'startTimeArray', 'toeicArray', 'englishLevelArray'));
     }


    public function showForm4(Request $request)
    {
      $input = $request->all();

      //セッションに書き込む
      $request->session()->put("register3_input", $input);

      //return view('st/auth.main.register4');
      return redirect()->action("Auth\RegisterController@confirm");
    }

    /*
     public function post(Request $request)
     {
       $input = $request->all();

       //セッションに書き込む
       $request->session()->put("register4_input", $input);

       return redirect()->action("Auth\RegisterController@confirm");
     }
     */

     function confirm(Request $request){
       //セッションから値を取り出す
       $register_input = $request->session()->get("register_input");
       $register2_input = $request->session()->get("register2_input");
       $register3_input = $request->session()->get("register3_input");
       //$register4_input = $request->session()->get("register4_input");

       $gender = "男";
       if($register_input['gender'] == 2){
         $gender = '女';
       }

       if(!is_null($register_input['supplement'])){
        $channel = $register_input['channel'].'('.$register_input['supplement'].')';
       } else{
        $channel = $register_input['channel'];
       }

       $confirmArray = [
         '性別' => $gender,
         '名前' => $register_input['lastname']. ' '. $register_input['firstname'],
         'フリガナ' => $register_input['kana_lastname']. ' '. $register_input['kana_firstname'],
         'ニックネーム' => $register_input['nickname'],
         'サービスを知ったきっかけ' => $channel,
         '大学名' => $register2_input['university'],
         '学部名' => $register2_input['faculty'],
         '学科名' => $register2_input['department'],
         '卒業年度' => $register2_input['graduate_year'],
         '志望する企業タイプ' => $register3_input['company_type'],
         '志望業界' => $register3_input['industry'],
         '志望職種' => $register3_input['jobtype'],
         '志望勤務地' => $register3_input['workplace'],
         '就活開始時期' => $register3_input['start_time'],
         '英語レベル' => $register3_input['english_level'],
         'TOEICスコア' => $register3_input['toeic'],
       ];

       //セッションに値が無い時はホームに戻る
       if(!($register_input && $register2_input && $register3_input)){
         return redirect()->route('home');
       }
       return view('st/auth.main.register_comfirm', compact('confirmArray'));
     }

     public function mainRegister(Request $request)
     {
       //セッションから値を取り出す
       $register_input = $request->session()->get("register_input");
       $register2_input = $request->session()->get("register2_input");
       $register3_input = $request->session()->get("register3_input");
       //$register4_input = $request->session()->get("register4_input");

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
       $user->name = $register_input['lastname']. ' '. $register_input['firstname'];
       $user->kana_name = $register_input['kana_lastname']. ' '. $register_input['kana_firstname'];
       $user->nickname = $register_input['nickname'];
       $user->university = $register2_input['university'];
       $user->university_class = RetUniversityClass::retUniversityClass($register2_input['university']);
       $user->faculty = $register2_input['faculty'];
       $user->department = $register2_input['department'];
       $user->major = $register2_input['major'];
       $user->graduate_year = $register2_input['graduate_year'];
       $user->gender = $register_input['gender'];
       $user->status = config('const.USER_STATUS.UNAVAILABLE');
       $user->company_type = $register3_input['company_type'];
       $user->industry = $register3_input['industry'];
       $user->jobtype = $register3_input['jobtype'];
       $user->english_level = $register3_input['english_level'];
       $user->toeic = $register3_input['toeic'];

       if(!is_null($register_input['supplement'])){
        $user->channel = $register_input['channel']. ':'. $register_input['supplement'];
      } else {
        $user->channel = $register_input['channel'];
      }

       $user->plan = "contributor";

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
       //$request->session()->forget("register4_input");

       return view('st/auth.main.registered');
     }
     function credit(Request $request){
       return view('st/auth.main.register_credit');
     }
}
