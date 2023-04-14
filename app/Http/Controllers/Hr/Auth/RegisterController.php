<?php

namespace App\Http\Controllers\Hr\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\HrUser;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerification;
use Carbon\Carbon;
use App\Common\ReturnUserInformationArrayClass;


class RegisterController extends Controller
{

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::Hr_HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:hr');
    }

    public function showRegistrationForm()
    {
      return view('hr.auth.register');
    }

    protected function guard(){
      return Auth::guard('hr');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
      /*
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        */
        return Validator::make($data, [
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
      $user = HrUser::create([
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'email_verify_token' => base64_encode($data['email']),
        'status' => config('const.USER_STATUS.PRE_REGISTER'),
      ]);

      Mail::send('hr.auth.email.pre_register', ['token' => $user['email_verify_token'] ], function ($message) use ($data){
        $message->subject('仮登録が完了しました');
        $message->from('mensetsu_zukan@example.com', 'デジマ面接図鑑');
        $message->to($data['email']);
      });

      return $user;
    }

    public function register(Request $request)
    {
      event(new Registered($user = $this->create( $request->all() )));

      $email = $user['email'];

      return view('hr.auth.registered', compact('email'));
    }

    public function showForm($email_token)
    {
        // 使用可能なトークンか
        if ( !HrUser::where('email_verify_token',$email_token)->exists() )
        {
            return view('hr.auth.main.register')->with('message', '無効なトークンです。');
        } else {
            $user = HrUser::where('email_verify_token', $email_token)->first();
            // 本登録済みユーザーか
            if ($user->status != config('const.USER_STATUS.PRE_REGISTER') && $user->status != config('const.USER_STATUS.MAIL_AUTHED'))
            {
                logger("status". $user->status );
                return view('hr.auth.main.register')->with('message', 'すでに本登録されています。ログインして利用してください。');
            }
            // ユーザーステータス更新
            $user->status = config('const.USER_STATUS.MAIL_AUTHED');
            $user->email_verified_at = Carbon::now('asia/Tokyo');
            if($user->save()) {
                return view('hr.auth.main.register', compact('email_token'));
            } else{
                return view('hr.auth.main.register')->with('message', 'メール認証に失敗しました。再度、メールからリンクをクリックしてください。');
            }
        }
    }

    public function showForm2(Request $request)
    {
      if(!empty($request->all())){
        $input = $request->all();
        
        //セッションに書き込む
        $request->session()->put("register_input", $input);
      }
      
      // どちらのプランかを示す変数
      $plan = $request->session()->get("register_input")['plan'];
      if($plan == "オファープラン"){
        //セッションに書き込む
        $request->session()->put("register2_input", NULL);

        $industryArray = ReturnUserInformationArrayClass::returnIndustry();
        $prefecturesArray = ReturnUserInformationArrayClass::returnPrefectures();
        $companyTypeArray = ReturnUserInformationArrayClass::returnCompanyTypeArray();
        $stockTypeArray = ReturnUserInformationArrayClass::returnStockTypeArray();

        return view('hr.auth.main.register3',  compact('industryArray', 'prefecturesArray', 'companyTypeArray', 'stockTypeArray'));
      }

      return view('hr.auth.main.register2', compact('plan'));
    }

    public function showForm3(Request $request)
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
        'kana_lastname.regex' => '全角カタカナで入力してください。',
        'kana_firstname.required' => 'フリガナを入力してください。',
        'kana_firstname.string' => '文字列を入力してください。',
        'kana_firstname.regex' => '全角カタカナで入力してください。',
        'nickname.required' => 'ニックネームを入力してください。',
        'nickname.string' => '文字列を入力してください。',
        'nickname.regex' => '日本語で入力してください。',
      ];
      $validator = Validator::make($input, $rules, $messages);
      $validated = $validator->validate(); //元のページにリダイレクトしてくれる。
      //=======================================================================

      //セッションに書き込む
      $request->session()->put("register2_input", $input);

      $industryArray = ReturnUserInformationArrayClass::returnIndustry();
      $prefecturesArray = ReturnUserInformationArrayClass::returnPrefectures();
      $companyTypeArray = ReturnUserInformationArrayClass::returnCompanyTypeArray();
      $stockTypeArray = ReturnUserInformationArrayClass::returnStockTypeArray();

      return view('hr.auth.main.register3', compact('industryArray', 'prefecturesArray', 'companyTypeArray', 'stockTypeArray'));
    }

    public function showForm4(Request $request)
    {
      $input = $request->all();

      //セッションに書き込む
      $request->session()->put("register3_input", $input);

      // どちらのプランかを示す変数
      $plan = $request->session()->get("register_input")['plan'];

      $prefecturesArray = ReturnUserInformationArrayClass::returnPrefectures();
      $selectionPhaseArray = ReturnUserInformationArrayClass::returnSelectionPhaseArray();

      return view('hr.auth.main.register4',compact('plan', 'prefecturesArray', 'selectionPhaseArray'));
    }

    //リダイレクト時にGETメソッドが送られるため
    public function redirectShowForm3()
    {
      $prefecturesArray = ReturnUserInformationArrayClass::returnPrefectures();
      $selectionPhaseArray = ReturnUserInformationArrayClass::returnSelectionPhaseArray();
      return view('hr.auth.main.register4',compact('prefecturesArray', 'selectionPhaseArray'));
    }

    public function post(Request $request)
    {
      $input = $request->all();

      //== Validator処理 ======================================================
      $rules = [
        'position' => 'nullable|string|regex:/^[^\x01-\x7E\x{FF61}-\x{FF9F}]+$/u',
        'summary' => 'nullable|string',
        'site' => 'nullable|url',
        'recruitment' => 'nullable|url',
      ];
      $messages = [
        'position.string' => '文字列で入力してください。',
        'position.regex' => '日本語で入力してください。',
        'position.summary' => '文字列で入力してください。',
        'site.url' => 'URLの形式で入力してください。',
        'recruitment.url' => 'URLの形式で入力してください。',
      ];
      $validator = Validator::make($input, $rules, $messages);
      $validated = $validator->validate(); //元のページにリダイレクトしてくれる。
      //=======================================================================

      //セッションに書き込む
      $request->session()->put("register4_input", $input);

      return redirect()->action("Hr\Auth\RegisterController@confirm");
    }

    function confirm(Request $request){
      //セッションから値を取り出す
      $register_input = $request->session()->get("register_input");
      $register2_input = $request->session()->get("register2_input");
      $register3_input = $request->session()->get("register3_input");
      $register4_input = $request->session()->get("register4_input");

      if($register_input['plan'] == "面接官プラン"){
        $gender = "男";
        if($register2_input['gender'] == 2){
          $gender = '女';
        }
      }

      $location = "未入力";
      if(!is_null($register3_input['location'])){
        $location = $register3_input['location'];
      }

      $workplace = "未入力";
      if(!is_null($register4_input['workplace'])){
        $workplace = $register4_input['workplace'];
      }

      $summary = "未入力";
      if(!is_null($register4_input['summary'])){
        $summary = $register4_input['summary'];
      }

      $site = "未入力";
      if(!is_null($register4_input['site'])){
        $site = $register4_input['site'];
      }

      $recruitment = "未入力";
      if(!is_null($register4_input['recruitment'])){
        $recruitment = $register4_input['recruitment'];
      }
      if($register_input['plan'] == "面接官プラン"){
        $face = '公開できない(モザイク加工をしてほしい)';
        if($register4_input['face']== 1){
          $face = '公開しても構わない';
        }
      }

      if($register_input['plan'] == "面接官プラン"){
        $confirmArray = [
          '性別' => $gender,
          '名前' => $register2_input['lastname']. ' '. $register2_input['firstname'],
          'フリガナ' => $register2_input['kana_lastname']. ' '. $register2_input['kana_firstname'],
          'ニックネーム' => $register2_input['nickname'],
          '企業名' => $register3_input['company'],
          '所属業界' => $register3_input['industry'],
          '本社所在地' => $location,
          '企業区分' => $register3_input['company_type'],
          '上場区分' => $register3_input['stock_type'],
          '担当選考フェーズ' => $register4_input['selection_phase'],
          '面接時に顔を公開したくありませんか？' => $face,
          '主な勤務地' => $workplace,
          '事業概要' => $summary,
          '企業ページURL' => $site,
          '募集要項URL' => $recruitment,
          'プラン' => $register_input['plan'],
        ];
      } else{
        $confirmArray = [
          '企業名' => $register3_input['company'],
          '所属業界' => $register3_input['industry'],
          '本社所在地' => $location,
          '企業区分' => $register3_input['company_type'],
          '上場区分' => $register3_input['stock_type'],
          '主な勤務地' => $workplace,
          '事業概要' => $summary,
          '企業ページURL' => $site,
          '募集要項URL' => $recruitment,
          'プラン' => $register_input['plan'],
        ];
      }

      //セッションに値が無い時はホームに戻る
      if(!($register_input && $register3_input && $register4_input)){
        if($register_input['plan'] == "面接官プラン"){
          return redirect()->route('home');
        } else {
          if(!($register2_input)){
            return redirect()->route('home');
          }
        }
      }
      return view('hr.auth.main.register_comfirm', compact('confirmArray'));
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
      if($register_input['plan'] == "面接官プラン"){
        if(!($register_input && $register2_input)){
          return redirect()->route('home');
        }
      } else{
        if(!($register_input)){
          return redirect()->route('home');
        }
      }

      //=====処理内容====================================
      $user = HrUser::where('email_verify_token', $register_input['email_verify_token'])->first();
      if($register_input['plan'] == "面接官プラン"){
        $user->name = $register2_input['lastname']. ' '. $register2_input['firstname'];
        $user->kana_name = $register2_input['kana_lastname']. ' '. $register2_input['kana_firstname'];
        $user->nickname = $register2_input['nickname'];
        $user->gender = $register2_input['gender'];

        $user->selection_phase = $register4_input['selection_phase'];
        $user->face = $register4_input['face'];
      } else{
        $user->name = $register3_input['company'];
      }
      $user->company = $register3_input['company'];
      $user->industry = $register3_input['industry'];
      $user->company_type = $register3_input['company_type'];
      $user->stock_type = $register3_input['stock_type'];
      

      $user->status = config('const.USER_STATUS.AVAILABLE');

      if($register_input['plan'] == 'オファープラン'){
        $user->plan = "offer";
      } else{
        $user->plan = "hr";
      }

      if(!is_null($register3_input['location'])){
        $user->location = $register3_input['location'];
      }
      if(!is_null($register4_input['workplace'])){
        $user->workplace = $register4_input['workplace'];
      }
      if(!is_null($register4_input['summary'])){
        $user->summary = $register4_input['summary'];
      }
      if(!is_null($register4_input['recruitment'])){
        $user->recruitment = $register4_input['recruitment'];
      }
      if(!is_null($register4_input['site'])){
        $user->site = $register4_input['site'];
      }

      $user->save();
      //================================================

      //セッションを空にする
      $request->session()->forget("register_input");
      $request->session()->forget("register2_input");
      $request->session()->forget("register3_input");
      $request->session()->forget("register4_input");

      return view('hr.auth.main.registered');
    }

    function credit(Request $request){
      return view('hr.auth.main.register_credit');
    }
}
