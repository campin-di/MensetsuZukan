<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\User;

class St_MypageBasicController extends Controller
{
  public function upload($stId)
  {
    $id = $stId;
    $profileImg = User::find($stId)->image_path;

    return view('st/mypage/upload/form', compact(['id', 'profileImg']));
  }

  function uploadPost(Request $request){
    $request->validate([
      'image' => 'required|file|image|mimes:png,jpeg'
    ]);
    $upload_image = $request->file('image');

    $stId = $request->input('id');

    if($upload_image) {
      //アップロードされた画像を保存する
      $path = 'storage/'. $upload_image->store('uploads/profile/st',"public");
      //画像の保存に成功したらDBに記録する
      if($path){
        $user = User::find($stId);
        $user->image_path =  $path;
        $user->save();
      }
    }

    return view("st/mypage/upload/form_complete");
  }

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
    $userData = User::find(Auth::user()->id);

    return view('st/mypage/basic/form', compact('userData'));
  }

  function post(Request $request){

    $input = $request->all();

    //===== validator処理====================================
    //================================================
  /*
    $validator = Validator::make($input, $this->validator);
    if($validator->fails()){
      return redirect()->action("St_MypageBasicController@show")
        ->withInput()
        ->withErrors($validator);
    }
  */
    //================================================
    //================================================
    //セッションに書き込む
    $request->session()->put("input", $input);

    return redirect()->action("St_MypageBasicController@confirm");
  }

  function confirm(Request $request){
    //セッションから値を取り出す
    $input = $request->session()->get("input");

    //セッションに値が無い時はフォームに戻る
    if(!$input){
      return redirect()->action("St_MypageBasicController@show");
    }

    $inputArray = [];
    if(isset($input['nickname'])){
      $inputArray['ニックネーム'] = $input['nickname'];
    }
    if(isset($input['password'])){
      $inputArray['パスワード'] = '********';
    }

    return view('st/mypage/basic/form_confirm', compact('inputArray'));
  }

  function send(Request $request){
    //セッションから値を取り出す
    $input = $request->session()->get("input");

    //戻るボタンが押された時
    if($request->has("back")){
      return redirect()->action("St_MypageBasicController@show")
        ->withInput($input);
    }

    //セッションに値が無い時はフォームに戻る
    if(!$input){
      return redirect()->action("St_MypageBasicController@show");
    }

    //=====処理内容====================================
    //================================================
    $user = User::find(Auth::user()->id);
    if(isset($input['nickname'])){
      $user->nickname =  $input['nickname'];
    }
    if(isset($input['password'])){
      $user->password = Hash::make($input['password']);
    }
    $user->save();

    //================================================
    //================================================

    //セッションを空にする
    $request->session()->forget("input");

    return redirect()->action("St_MypageBasicController@complete");
  }

  function complete(){
    return view('st/mypage/basic/form_complete');
  }

  /*===========================================================================*/
}
