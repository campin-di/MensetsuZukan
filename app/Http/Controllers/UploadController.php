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

use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Log;

class UploadController extends Controller
{
  public function __construct()
  {
      // :point_down: アクセストークン
      $this->access_token = env('LINE_ACCESS_TOKEN');
      // :point_down: チャンネルシークレット
      $this->channel_secret = env('LINE_CHANNEL_SECRET');
  }

  function showRegister(){
    $alreadyInterviewIds = Video::groupBy('interview_id')->select('interview_id')->get()->toArray();
    $alreadyInterviewIds = array_column($alreadyInterviewIds, 'interview_id');

    $interviews = Interview::whereNotIn('id', $alreadyInterviewIds)->where('available', -1)->with('st_user')->with('hr_user')->select('id', 'st_id', 'hr_id', 'date', 'time')->get();

    $interviewCollection = collect();
    foreach ($interviews as $interview) {
      $interviewCollection = $interviewCollection->concat([
        [
          'id' => $interview->id,
          'stId' => $interview->st_id,
          'stName' => $interview->st_user->name,
          'stNickname' => $interview->st_user->nickname,
          'hrId' => $interview->hr_id,
          'hrName' => $interview->hr_user->name,
          'hrNickname' => $interview->hr_user->nickname,
          'date' => $interview->date,
          'time' => $interview->time,
        ],
      ]);
    }

    return view("admin/register/form", compact('interviewCollection'));
  }
  
  function register(Request $request){
    $input = $request->all();

    if(!$input){
      return redirect()->action("UploadController@show");
    }
    
    //=====処理内容====================================
    $interview = Interview::find($input["interview_id"]);

    $stData = User::find($interview->st_id);
    $hrData = HrUser::find($interview->hr_id);

    $scores = ScoringAlgorithmClass::scoringAlgorithm($interview);

    $video_st = new Video;
    $video_st->thumbnail_path = "img/contents/thumbnail.png";
    $video_st->vimeo_src = "https://player.vimeo.com/video/624314546?h=3b02e03875&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479";
    $video_st->vimeo_id = '624314546';
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
    $video_hr->thumbnail_path = "img/contents/thumbnail.png";
    $video_hr->vimeo_src = "https://player.vimeo.com/video/624314546?h=3b02e03875&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479";
    $video_hr->vimeo_id = '624314546';
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

    $msg1 = "模擬面接の採点結果が公表されました！";
    $msg2 = "マイページよりご確認いただけます！";
    $this->lineNotification($stData, $hrData, $msg1, $msg2);

    return view("admin/upload/form_complete");
  }
  
  function showUpload(){
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
    $stVimeoArray = array_reverse(explode('/', $input['st_vimeo_url']));
    $stVideo = Video::find($input["st_video_id"]);
    $stVideo->vimeo_src = 'https://player.vimeo.com/video/'. $stVimeoArray[1] .'?h='. $stVimeoArray[0] .'&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479';
    $stVideo->save();

    $hrVimeoArray = array_reverse(explode('/', $input['hr_vimeo_url']));
    $hrVideo = Video::find($input["hr_video_id"]);
    $hrVideo->vimeo_src = 'https://player.vimeo.com/video/'. $hrVimeoArray[1] .'?h='. $hrVimeoArray[0] .'&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479';
    $hrVideo->save();

    //================================================
    //================================================
    
    $stData = User::find($stVideo->st_id);
    $hrData = HrUser::find($stVideo->hr_id);
    $msg1 = "模擬面接の録画がアップロードされました！";
    $msg2 = "もう一度、自身の面接と人事さんからの評価を照らし合わせて、面接力をアップさせましょう！";
    $this->lineNotification($stData, $hrData, $msg1, $msg2);

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

  public function lineNotification($st, $hr, $msg1, $msg2) { // 面接予約時にLINE通知する関数
    //本会員登録リンク 送信部分
    $http_client = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($this->access_token);
    $bot         = new \LINE\LINEBot($http_client, ['channelSecret' => $this->channel_secret]);

    $builder = new \LINE\LINEBot\MessageBuilder\MultiMessageBuilder();
    // ビルダーにメッセージをすべて追加
    $msgs = [
        new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($msg1),
        new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($msg2),
    ];
    foreach($msgs as $value){
        $builder->add($value);
    }
    $response = $bot->pushMessage($st->line_id, $builder);

    // 配信成功・失敗
    if ($response->isSucceeded()) {
        Log::info('Line 送信完了');
    } else {
        Log::error('投稿失敗: ' . $response->getRawBody());
    }
  }
}
