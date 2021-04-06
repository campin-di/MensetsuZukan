<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Hr_profile;

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
    $profile = hr_profile::where('hr_id', $userId)->first();

    $profileCollection = collect();

    if(is_null($profile)){
      $profileCollection = $profileCollection->concat([
        [
          'introduction' => "設定されていません。",
          'pr' => "設定されていません。"
        ],
      ]);
    } else {
      $profileCollection = $profileCollection->concat([
        [
          'introduction' => $profile->introduction,
          'pr' => $profile->pr
        ],
      ]);
    }

    return view("hr/hrMypage/detail/form",[
      'profileCollection' => $profileCollection,
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
    //================================================
    $userId = Auth::guard('hr')->id();
    \DB::table('hr_profiles')->where('hr_id', $userId)->update([
          'pr' => $input['pr'],
          'introduction' => $input['introduction'],
        ]);
    //================================================
    //================================================

    //セッションを空にする
    $request->session()->forget("detail_input");

    return redirect()->action("Hr_HrMypageDetailController@complete");
  }

  function complete(){
    return view("hr/hrMypage/detail/form_complete");
  }

  /*===========================================================================*/

}
