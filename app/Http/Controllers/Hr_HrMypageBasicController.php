<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\HrUser;


class Hr_HrMypageBasicController extends Controller
{
  public function upload($id)
  {
    $profileImg = HrUser::find(Auth::guard('hr')->id())->image_path;

    return view('hr/mypage/upload/form', compact(['id', 'profileImg']));
  }

  function uploadPost(Request $request){
    $request->validate([
      'image' => 'required|file|image|mimes:png,jpeg'
    ]);
    $upload_image = $request->file('image');

    $id = $request->input('id');

    if($upload_image) {
      //アップロードされた画像を保存する
      $path = 'storage/'. $upload_image->store('uploads/profile/hr',"public");
      //画像の保存に成功したらDBに記録する
      if($path){
        $user = HrUser::find($id);
        $user->image_path =  $path;
        $user->save();
      }
    }

    return view("hr/mypage/upload/form_complete");
  }

  /*=== 基本情報の変更処理 ====================================================*/
  function show(){
    $userData = HrUser::find(Auth::guard('hr')->id());

    return view("hr/mypage/basic/form", compact('userData'));
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

    $inputArray = [];
    if(isset($input['password'])){
      $inputArray['パスワード'] = '********';
    }

    return view("hr/mypage/basic/form_confirm", compact('inputArray'));
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
    $user = HrUser::find(Auth::guard('hr')->id());
    if(isset($input['password'])){
      $user->password = Hash::make($input['password']);
    }
    $user->save();
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
