<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Common\ReturnUserInformationArrayClass;

class St_MypageDetailController extends Controller
{
  /*=== 基本情報の変更処理 ====================================================*/

  private $formItems = ["name", "title", "body"];

  private $validator = [
    /*
    "name" => "required|string|max:100",
    "title" => "required|string|max:100",
    "body" => "required|string|max:100"
    */
  ];

  function step1(){
    $userData = User::find(Auth::user()->id);

    $industryArray = ReturnUserInformationArrayClass::returnIndustry();
    $jobtypeArray = ReturnUserInformationArrayClass::returnJobtypeArray();
    $prefecturesArray = ReturnUserInformationArrayClass::returnPrefectures();
    $toeicArray = ReturnUserInformationArrayClass::returnToeicArray();

    return view('st/mypage/detail/step1',compact(['userData', 'industryArray', 'jobtypeArray', 'prefecturesArray', 'toeicArray']));
  }

  public function step2(Request $request){
    $input = $request->all();
    $request->session()->put("step1", $input);

    $userData = User::find(Auth::user()->id);

    return view('st/mypage/detail/step2', compact('userData'));
  }

  function post(Request $request){

    $input = $request->all();

    //セッションに書き込む
    $request->session()->put("step2", $input);

    return redirect()->action("St_MypageDetailController@confirm");
  }

  function confirm(Request $request){
    //セッションから値を取り出す
    $step1 = $request->session()->get("step1");
    $step2 = $request->session()->get("step2");

    //セッションに値が無い時はフォームに戻る
    if(!$step1 || !$step2){
      return redirect()->action("St_MypageDetailController@step1");
    }

    $indexArray = [
      'company_type' => '志望する企業タイプ',
      'industry' => '志望業界',
      'jobtype' => '志望職種',
      'workplace' => '希望勤務地',
      'start_time' => '就活を開始したのはいつですか？',
      'english_level' => '英語レベル',
      'toeic' => 'TOEICスコア',
      'introduction' => '簡単な自己紹介',
      'strengths' => '自分の強み',
      'gakuchika' => 'ガクチカ',
      'personality' => '自分の性格',
      'other_language' => '英語以外の言語使用経験',
      'qualification' => '資格・受賞歴等',
    ];

    $input = [];
    $confirmArray = [];
    foreach ($step1 as $name => $value) {
      if($name != '_token') {
        $input[$name] = $value;
        $confirmArray[$indexArray[$name]] = $value;
      }
    }
    foreach ($step2 as $name => $value) {
      if($name != '_token') {
        $input[$name] = $value;
        $confirmArray[$indexArray[$name]] = $value;
      }
    }
    //sessionにinputのデータを統合
    session(['input' => $input]);

    $request->session()->forget('step1', 'step2');

    return view('st/mypage/detail/form_confirm',compact(['confirmArray']));
  }

  function send(Request $request){
    //セッションから値を取り出す
    $input = $request->session()->get("input");

    //戻るボタンが押された時
    if($request->has("back")){
      return redirect()->action("St_MypageDetailController@step1")
        ->withInput($input);
    }

    //セッションに値が無い時はフォームに戻る
    if(!$input){
      return redirect()->action("St_MypageDetailController@step1");
    }

    //=====処理内容====================================
    //================================================
    $user = User::find(Auth::user()->id);
    foreach ($input as $key => $value) {
      $user->$key = $value;
    }
    $user->save();

    //================================================
    //================================================

    //セッションを空にする
    $request->session()->forget("input");

    return redirect()->action("St_MypageDetailController@complete");
  }

  function complete(){
    return view('st/mypage/detail/form_complete');
  }

  /*===========================================================================*/

}
