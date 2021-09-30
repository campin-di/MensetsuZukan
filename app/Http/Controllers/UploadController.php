<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HrUser;
use App\Models\Video;
use App\Models\Interview;
use App\Models\Question;

use App\Common\ScoringAlgorithmClass;
use Validator;

/*==============================
部分処理と書いているところ以外はコピペで使い回しできると思う。
==============================*/

class UploadController extends Controller
{
    function show(){
      return view("admin/upload/form");
    }

    function post(Request $request){
      $input = $request->all();
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

      $scores = ScoringAlgorithmClass::scoringAlgorithm($interview);

      $video_st = new Video;
      $video_st->vimeo_src = 'https://player.vimeo.com/video/' . $input["st_vimeo_id"] . '?h=cfd7d8ebbe&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479';
      $video_st->vimeo_id = $input["st_vimeo_id"];
      $video_st->st_id = $interview->st_id;
      $video_st->hr_id = $interview->hr_id;
      $video_st->interview_id = $input["interview_id"];
      $video_st->question_1_id = $interview->question_1_id;
      $video_st->question_2_id = $interview->question_2_id;
      $video_st->question_3_id = $interview->question_3_id;
      $video_st->basic_score = $scores["basic"];
      $video_st->expression_score = $scores["expression"];
      $video_st->logical_score = $scores["logical"];
      $video_st->vitality_score = $scores["vitality"];
      $video_st->creative_score = $scores["creative"];
      $video_st->review_good = $interview->review_good;
      $video_st->review_more = $interview->review_more;
      $video_st->views = 0;
      $video_st->good = 0;
      $video_st->type = 0;
      $video_st->save();

      $video_hr = new Video;
      $video_hr->vimeo_src = 'https://player.vimeo.com/video/' . $input["hr_vimeo_id"] . '?h=cfd7d8ebbe&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479';
      $video_hr->vimeo_id = $input["hr_vimeo_id"];
      $video_hr->st_id = $interview->st_id;
      $video_hr->hr_id = $interview->hr_id;
      $video_hr->interview_id = $input["interview_id"];
      $video_hr->question_1_id = $interview->question_1_id;
      $video_hr->question_2_id = $interview->question_2_id;
      $video_hr->question_3_id = $interview->question_3_id;
      $video_hr->basic_score = $scores["basic"];
      $video_hr->expression_score = $scores["expression"];
      $video_hr->logical_score = $scores["logical"];
      $video_hr->vitality_score = $scores["vitality"];
      $video_hr->creative_score = $scores["creative"];
      $video_hr->review_good = $interview->review_good;
      $video_hr->review_more = $interview->review_more;
      $video_hr->views = 0;
      $video_hr->good = 0;
      $video_hr->type = 1;
      $video_hr->save();

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

      return redirect()->action("AdminController@index");
    }

    function cut($time){
      $secs = explode(':', $time);
      $sec = $secs[0]*60 + $secs[1];

      return $sec;
    }
}
