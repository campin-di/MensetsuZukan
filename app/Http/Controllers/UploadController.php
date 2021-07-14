<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HrUser;
use App\Models\Video;
use App\Models\Interview;
use App\Models\Question;

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
      return view("admin/upload/form");
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
      return view("admin/upload/form_confirm",["input" => $input]);
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
      $interview = Interview::find($input["interview_id"]);

      $stData = User::find($interview->st_id);
      $hrData = HrUser::find($interview->hr_id);

      
      $score = 0;
      for ($i=1; $i <=3 ; $i++) {
        $questionLogic = 'question_'. $i . '_logic';
        $questionPersonality = 'question_'. $i . '_personality';

        if($i == 1){
          $weight = 2;
        }else{
          $weight = 4;
        }
        $score += ($interview->$questionLogic * $weight) + ($interview->$questionPersonality * $weight);
      }
      
      for ($i=1; $i <=3 ; $i++) {
        $questionId = 'question_'. $i . '_id';
        $questionLogic = 'question_'. $i . '_logic';
        $questionPersonality = 'question_'. $i . '_personality';
        $questionScore = 'question_'. $i . '_score';
        $questionReview = 'question_'. $i . '_review';
        $startSecond = 'start_time_'. $i;

        $question = Question::find($interview->$questionId)->name;
        if($input['type'] == 'hr'){
          $title = $stData->name . "さんの「". $question . "」に対する答え方";
          $type = 1;
        } else {
          $title = $stData->nickname . "さんの「". $question . "」に対する答え方";
          $type = 0;
        }

        $video = new Video;
        $video->title = $title;
        //$video->thumbnail_src = $input["thumbnail_src"];
        $video->vimeo_src = 'https://player.vimeo.com/video/' . $input["vimeo_id"] . '#t=' . $input[$startSecond].'s?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479';
        $video->vimeo_id = $input["vimeo_id"];
        $video->question_id = $interview->$questionId;
        $video->st_id = $interview->st_id;
        $video->hr_id = $interview->hr_id;
        $video->logic = $interview->$questionLogic;
        $video->personality = $interview->$questionPersonality;
        $video->score = $score;
        $video->review_good = $interview->review_good;
        $video->review_more = $interview->review_more;
        $video->review_message = $interview->review_message;
        $video->views = 0;
        $video->good = 0;
        $video->type = $type;
        $video->save();
      }

      //================================================
      //================================================

      //セッションを空にする
      $request->session()->forget("form_input");

      return redirect()->action("UploadController@complete");
    }

    function complete(){
      return view("admin/upload/form_complete");
    }

    function thumbnail($videoId){
      return view("admin/upload/thumbnail", compact('videoId'));
    }

    function thumbnailPost(Request $request){
      $request->validate([
        'image' => 'required|file|image|mimes:png,jpeg'
      ]);
      $upload_image = $request->file('image');

      $videoId = $request->input('video_id');

      if($upload_image) {
  			//アップロードされた画像を保存する
  			$path = 'storage/'. $upload_image->store('uploads',"public");
  			//画像の保存に成功したらDBに記録する
  			if($path){
          $video = Video::find($videoId);
          $video->thumbnail_name =  $upload_image->getClientOriginalName();
          $video->thumbnail_path =  $path;
          $video->save();
  			}
  		}

      return view("admin/upload/form_complete");
    }
}
