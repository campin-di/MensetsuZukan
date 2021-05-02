<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\HrUser;

class Hr_HrMypageDetailController extends Controller
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

  function show(){
    $userId = Auth::guard('hr')->id();
    $userData = HrUser::find($userId);

    $profileDetailArray = [
      'company' => $userData->company,
      'companyType' => $userData->company_type,
      'industry' => $userData->industry,
      'position' => $userData->position,
      'pr' => $userData->pr,
    ];

    return view("hr/hrMypage/detail/form",[
      'profileDetailArray' => $profileDetailArray,
    ]);
  }

  function post(Request $request){

    $input = $request->all();

    //===== validator処理====================================
    //================================================
  /*
    $validator = Validator::make($input, $this->validator);
    if($validator->fails()){
      return redirect()->action("MypageDetailController@show")
        ->withInput()
        ->withErrors($validator);
    }
  */
    //================================================
    //================================================
    //セッションに書き込む
    $request->session()->put("detail_input", $input);

    return redirect()->action("Hr_HrMypageDetailController@confirm");
  }

  function confirm(Request $request){
    //セッションから値を取り出す
    $input = $request->session()->get("detail_input");

    //セッションに値が無い時はフォームに戻る
    if(!$input){
      return redirect()->action("Hr_HrMypageDetailController@show");
    }
    return view("hr/hrMypage/detail/form_confirm",["input" => $input]);
  }

  function send(Request $request){
    //セッションから値を取り出す
    $input = $request->session()->get("detail_input");

    //戻るボタンが押された時
    if($request->has("back")){
      return redirect()->action("Hr_HrMypageDetailController@show")
        ->withInput($input);
    }

    //セッションに値が無い時はフォームに戻る
    if(!$input){
      return redirect()->action("Hr_HrMypageDetailController@show");
    }

    //=====処理内容====================================

    $userId = Auth::guard('hr')->id();
    $user = HrUser::find($userId);
    $user->company = $input['company'];
    $user->industry = $input['industry'];
    $user->location = $input['location'];
    $user->company_type = $input['company_type'];

    if(!is_null($input['position'])){
      $user->position = $input['position'];
    }
    if(!is_null($input['workplace'])){
      $user->workplace = $input['workplace'];
    }
    if(!is_null($input['summary'])){
      $user->summary = $input['summary'];
    }
    if(!is_null($input['recruitment'])){
      $user->recruitment = $input['recruitment'];
    }
    if(!is_null($input['site'])){
      $user->site = $input['site'];
    }

    if(!is_null($input['pr'])){
      $user->pr = $input['pr'];
    }
    $user->save();

    //================================================

    //セッションを空にする
    $request->session()->forget("detail_input");

    return redirect()->action("Hr_HrMypageDetailController@complete");
  }

  function complete(){
    return view("hr/hrMypage/detail/form_complete");
  }
}
