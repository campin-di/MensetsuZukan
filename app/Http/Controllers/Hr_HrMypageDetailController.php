<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\HrUser;
use App\Common\ReturnUserInformationArrayClass;

class Hr_HrMypageDetailController extends Controller
{
  /*=== 基本情報の変更処理 ====================================================*/

  function step1(){
    $userData = HrUser::find(Auth::guard('hr')->id());

    $prefecturesArray = ReturnUserInformationArrayClass::returnPrefectures();
    $companyTypeArray = ReturnUserInformationArrayClass::returnCompanyTypeArray();
    $selectionPhaseArray = ReturnUserInformationArrayClass::returnSelectionPhaseArray();
    $stockTypeArray = ReturnUserInformationArrayClass::returnStockTypeArray();

    return view("hr/mypage/detail/step1", compact(['userData', 'prefecturesArray', 'selectionPhaseArray', 'companyTypeArray', 'stockTypeArray']));
  }

  function step2(Request $request){
    $input = $request->all();
    $request->session()->put("step1", $input);

    $userData = HrUser::find(Auth::guard('hr')->id());
    return view('hr/mypage/detail/step2', compact('userData'));
  }

  function post(Request $request){

    $input = $request->all();

    $request->session()->put("step2", $input);

    return redirect()->action("Hr_HrMypageDetailController@confirm");
  }

  function confirm(Request $request){
    $step1 = $request->session()->get("step1");
    $step2 = $request->session()->get("step2");

    //セッションに値が無い時はフォームに戻る
    if(!$step1 || !$step2){
      return redirect()->action("Hr_HrMypageDetailController@step1");
    }

    $indexArray = [
      'location' => '本社所在地',
      'workplace' => '主な勤務地',
      'company_type' => '企業区分',
      'stock_type' => '上場区分',
      'summary' => '事業概要',
      'site' => '企業ページURL',
      'recruitment' => '採用ページURL',
      'selection_phase' => '普段担当する選考フェーズ',
      'introduction' => '簡単な自己紹介',
      'pr' => '面接官PR',
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

    return view('hr/mypage/detail/form_confirm',compact(['confirmArray']));
  }

  function send(Request $request){
    $input = $request->session()->get("input");

    //戻るボタンが押された時
    if($request->has("back")){
      return redirect()->action("Hr_HrMypageDetailController@step1")
        ->withInput($input);
    }

    //セッションに値が無い時はフォームに戻る
    if(!$input){
      return redirect()->action("Hr_HrMypageDetailController@show");
    }

    //=====処理内容====================================
    $user = HrUser::find(Auth::guard('hr')->id());
    foreach ($input as $key => $value) {
      $user->$key = $value;
    }
    $user->save();
    //================================================

    $request->session()->forget("input");

    return redirect()->action("Hr_HrMypageDetailController@complete");
  }

  function complete(){
    return view("hr/mypage/detail/form_complete");
  }
}
