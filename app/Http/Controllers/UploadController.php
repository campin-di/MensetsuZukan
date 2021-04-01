<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HrUser;
use App\Models\Video;

use Validator;

/*==============================
部分処理と書いているところ以外はコピペで使い回しできると思う。
==============================*/

class UploadController extends Controller
{
    private $formItems = ["name", "title", "body"];

    private $validator = [
      /*
      "name" => "required|string|max:100",
      "title" => "required|string|max:100",
      "body" => "required|string|max:100"
      */
    ];

    function show(){
      return view("upload/form");
    }

    function post(Request $request){

      $input = $request->all();

      //=====部分処理====================================
      //================================================
/*
      $validator = Validator::make($input, $this->validator);
      if($validator->fails()){
        return redirect()->action("UploadController@show")
          ->withInput()
          ->withErrors($validator);
      }
*/
      //================================================
      //================================================
      //セッションに書き込む
      $request->session()->put("form_input", $input);

      return redirect()->action("UploadController@confirm");
    }

    function confirm(Request $request){
      //セッションから値を取り出す
      $input = $request->session()->get("form_input");

      //セッションに値が無い時はフォームに戻る
      if(!$input){
        return redirect()->action("UploadController@show");
      }
      return view("upload/form_confirm",["input" => $input]);
    }

    function send(Request $request){
      //セッションから値を取り出す
      $input = $request->session()->get("form_input");

      //戻るボタンが押された時
      if($request->has("back")){
        return redirect()->action("UploadController@show")
          ->withInput($input);
      }

      //セッションに値が無い時はフォームに戻る
      if(!$input){
        return redirect()->action("UploadController@show");
      }

      //=====処理内容====================================
      //================================================
      $stData = User::where('username', $input["st_username"])->first();
      $hrData = HrUser::where('username', $input["hr_username"])->first();

      $question = $input["question"];
      $title = $stData->username . "さんの". $question . "に対する答え方";
      $commonUrlArray = explode("&t=", $input["url"]);

      $video = new Video;
      $video->title = $title;
      $video->url = $input["url"];
      $video->common_url = $commonUrlArray[0];
      $video->question = $question;
      $video->st_id = $stData->id;
      $video->hr_id = $hrData->id;
      $video->score = $input["score"];
      $video->review = $input["review"];
      $video->views = 0;
      $video->good = 0;
      $video->save();
      //================================================
      //================================================

      //セッションを空にする
      $request->session()->forget("form_input");

      return redirect()->action("UploadController@complete");
    }

    function complete(){
      return view("upload/form_complete");
    }

}
