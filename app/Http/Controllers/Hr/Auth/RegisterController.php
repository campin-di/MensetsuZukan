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
        $message->from('mensetsu_zukan@example.com');
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
            if ($user->status == config('const.USER_STATUS.REGISTER')) //REGISTER=1
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
      $input = $request->all();

      //== Validator処理 ======================================================
      $rules = [
        //全角カナだけ通す正規表現：regex:/^[^\x01-\x7E\x{FF61}-\x{FF9F}]+$/u'
        'gender' => 'required|digits_between:1,2',
        'lastname' => 'required|string|regex:/^[^\x01-\x7E\x{FF61}-\x{FF9F}]+$/u',
        'firstname' => 'required|string|regex:/^[^\x01-\x7E\x{FF61}-\x{FF9F}]+$/u',
        'kana_lastname' => 'required|string|regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u',
        'kana_firstname' => 'required|string|regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u',
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
      ];
      $validator = Validator::make($input, $rules, $messages);
      $validated = $validator->validate(); //元のページにリダイレクトしてくれる。
      //=======================================================================

        //セッションに書き込む
        $request->session()->put("register_input", $input);

        $industryArray = ReturnUserInformationArrayClass::returnIndustry();
        $prefecturesArray = ReturnUserInformationArrayClass::returnPrefectures();
        $companyTypeArray = ReturnUserInformationArrayClass::returnCompanyTypeArray();
        $stockTypeArray = ReturnUserInformationArrayClass::returnStockTypeArray();

        return view('hr.auth.main.register2', compact('industryArray', 'prefecturesArray', 'companyTypeArray', 'stockTypeArray'));
    }

    public function showForm3(Request $request)
    {
        $input = $request->all();

        //セッションに書き込む
        $request->session()->put("register2_input", $input);

        $prefecturesArray = ReturnUserInformationArrayClass::returnPrefectures();
        $selectionPhaseArray = ReturnUserInformationArrayClass::returnSelectionPhaseArray();

        return view('hr.auth.main.register3',compact('prefecturesArray', 'selectionPhaseArray'));
    }

    //リダイレクト時にGETメソッドが送られるため
    public function redirectShowForm3()
    {
      $prefecturesArray = ReturnUserInformationArrayClass::returnPrefectures();
      $selectionPhaseArray = ReturnUserInformationArrayClass::returnSelectionPhaseArray();
      return view('hr.auth.main.register3',compact('prefecturesArray', 'selectionPhaseArray'));
    }

    public function showForm4(Request $request)
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
        $request->session()->put("register3_input", $input);

        return view('hr.auth.main.register4');
    }

    public function post(Request $request)
    {
      $input = $request->all();

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

      $gender = "男";
      if($register_input['gender'] == 2){
        $gender = '女';
      }

      $selection_phase = "未入力";
      if(!is_null($register3_input['selection_phase'])){
        $selection_phase = $register3_input['selection_phase'];
      }

      $workplace = "未入力";
      if(!is_null($register3_input['workplace'])){
        $workplace = $register3_input['workplace'];
      }

      $summary = "未入力";
      if(!is_null($register3_input['summary'])){
        $summary = $register3_input['summary'];
      }

      $site = "未入力";
      if(!is_null($register3_input['site'])){
        $site = $register3_input['site'];
      }

      $recruitment = "未入力";
      if(!is_null($register3_input['recruitment'])){
        $recruitment = $register3_input['recruitment'];
      }

      $confirmArray = [
        '性別' => $gender,
        '名前' => $register_input['lastname']. ' '. $register_input['firstname'],
        'フリガナ' => $register_input['kana_lastname']. ' '. $register_input['kana_firstname'],
        '企業名' => $register2_input['company'],
        '所属業界' => $register2_input['industry'],
        '本社所在地' => $register2_input['location'],
        '企業区分' => $register2_input['company_type'],
        '上場区分' => $register2_input['stock_type'],
        '担当選考フェーズ' => $selection_phase,
        '主な勤務地' => $workplace,
        '事業概要' => $summary,
        '企業ページURL' => $site,
        '募集要項URL' => $recruitment,
        'プラン' => $register4_input['plan'],
      ];

      //セッションに値が無い時はホームに戻る
      if(!($register_input && $register2_input && $register3_input && $register4_input)){
        return redirect()->route('home');
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
      if(!($register_input && $register2_input)){
        return redirect()->route('home');
      }

      //=====処理内容====================================
      $user = HrUser::where('email_verify_token', $register_input['email_verify_token'])->first();
      $user->name = $register_input['lastname']. ' '. $register_input['firstname'];
      $user->kana_name = $register_input['kana_lastname']. ' '. $register_input['kana_firstname'];
      $user->gender = $register_input['gender'];
      $user->company = $register2_input['company'];
      $user->industry = $register2_input['industry'];
      $user->location = $register2_input['location'];
      $user->company_type = $register2_input['company_type'];
      $user->stock_type = $register2_input['stock_type'];

      $user->status = config('const.USER_STATUS.UNAVAILABLE');

      if($register4_input['plan'] == 'オファープラン'){
        $user->plan = "offer";
      } else{
        $user->plan = "hr";
      }

      if(!is_null($register3_input['selection_phase'])){
        $user->selection_phase = $register3_input['selection_phase'];
      }
      if(!is_null($register3_input['workplace'])){
        $user->workplace = $register3_input['workplace'];
      }
      if(!is_null($register3_input['summary'])){
        $user->summary = $register3_input['summary'];
      }
      if(!is_null($register3_input['recruitment'])){
        $user->recruitment = $register3_input['recruitment'];
      }
      if(!is_null($register3_input['site'])){
        $user->site = $register3_input['site'];
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
