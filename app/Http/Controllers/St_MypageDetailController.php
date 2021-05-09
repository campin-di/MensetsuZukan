<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\St_profile;

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

  function show(){
    $userId = Auth::user()->id;
    $profile = St_profile::where('st_id', $userId)->first();

    return view('st/mypage/detail/form',[
      'profile' => $profile,
    ]);
  }

  function post(Request $request){

    $input = $request->all();

    //===== validator処理====================================
    //================================================
  /*
    $validator = Validator::make($input, $this->validator);
    if($validator->fails()){
      return redirect()->action("St_MypageDetailController@show")
        ->withInput()
        ->withErrors($validator);
    }
  */
    //================================================
    //================================================
    //セッションに書き込む
    $request->session()->put("detail_input", $input);

    return redirect()->action("St_MypageDetailController@confirm");
  }

  function confirm(Request $request){
    //セッションから値を取り出す
    $input = $request->session()->get("detail_input");

    //セッションに値が無い時はフォームに戻る
    if(!$input){
      return redirect()->action("St_MypageDetailController@show");
    }
    return view('st/mypage/detail/form_confirm',["input" => $input]);
  }

  function send(Request $request){
    //セッションから値を取り出す
    $input = $request->session()->get("detail_input");

    //戻るボタンが押された時
    if($request->has("back")){
      return redirect()->action("St_MypageDetailController@show")
        ->withInput($input);
    }

    //セッションに値が無い時はフォームに戻る
    if(!$input){
      return redirect()->action("St_MypageDetailController@show");
    }

    //=====処理内容====================================
    //================================================
    $userId = Auth::user()->id;
    \DB::table('st_profiles')->where('id', $userId)->update([
            'pr' => $input["pr"],
            'gakuchika' => $input["gakuchika"],
            'frustration' => $input["frustration"],
        ]);
    //================================================
    //================================================

    //セッションを空にする
    $request->session()->forget("detail_input");

    return redirect()->action("St_MypageDetailController@complete");
  }

  function complete(){
    return view('st/mypage/detail/form_complete');
  }

  /*===========================================================================*/

}
