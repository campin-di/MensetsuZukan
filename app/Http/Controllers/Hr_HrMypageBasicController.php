<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class Hr_HrMypageBasicController extends Controller
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
    return view("hr/mypage/basic/form");
  }

  function post(Request $request){

    $input = $request->all();

    //===== validator処理====================================
    //================================================
  /*
    $validator = Validator::make($input, $this->validator);
    if($validator->fails()){
      return redirect()->action("MypageBasicController@show")
        ->withInput()
        ->withErrors($validator);
    }
  */
    //================================================
    //================================================
    //セッションに書き込む
    $request->session()->put("input", $input);

    return redirect()->action("Hr_HrMypageBasicController@confirm");
  }

  function confirm(Request $request){
    //セッションから値を取り出す
    $input = $request->session()->get("input");

    //セッションに値が無い時はフォームに戻る
    if(!$input){
      return redirect()->action("Hr_HrMypageBasicController@show");
    }
    return view("hr/mypage/basic/form_confirm",["input" => $input]);
  }

  function send(Request $request){
    //セッションから値を取り出す
    $input = $request->session()->get("input");

    //戻るボタンが押された時
    if($request->has("back")){
      return redirect()->action("Hr_HrMypageBasicController@show")
        ->withInput($input);
    }

    //セッションに値が無い時はフォームに戻る
    if(!$input){
      return redirect()->action("Hr_HrMypageBasicController@show");
    }

    //=====処理内容====================================
    //================================================
    $userId = Auth::guard('hr')->id();
    \DB::table('hr_users')->where('id', $userId)->update([
            'username' => $input["username"],
            'password' => Hash::make($input["password"]),
        ]);
    //================================================
    //================================================

    //セッションを空にする
    $request->session()->forget("input");

    return redirect()->action("Hr_HrMypageBasicController@complete");
  }

  function complete(){
    return view("hr/mypage/basic/form_complete");
  }

  /*===========================================================================*/

}
