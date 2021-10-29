<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Common\ScoringTermsClass;
use App\Models\User;
use App\Models\HrUser;
use App\Models\Interview;
use App\Models\Question;
use App\Models\Batting;

use Carbon\Carbon;
use DateTime;
use Log;

class Hr_ScoringController extends Controller
{
  public function __construct()
  {
      // :point_down: アクセストークン
      $this->access_token = env('LINE_ACCESS_TOKEN');
      // :point_down: チャンネルシークレット
      $this->channel_secret = env('LINE_CHANNEL_SECRET');
  }
  //== 質問リスト作成 関係　=======================================================
  public function form($id)
  {
    $questions = Question::get();
    $scoringTerms = ScoringTermsClass::scoringTerms();
    $zoomUrl = Interview::find($id)->zoomUrl;

    return view('hr/interview/scoring/form', compact('id', 'questions', 'scoringTerms', 'zoomUrl'));
  }

  public function post(Request $request)
  {
    $input = $request->all();

    //セッションに書き込む
    $request->session()->put("form_input", $input);

    return redirect()->action("Hr_ScoringController@confirm");
  }

  function confirm(Request $request){
    //セッションから値を取り出す
    $input = $request->session()->get("form_input");

    //セッションに値が無い時はフォームに戻る
    if(!$input){
      return redirect()->action("Hr_HrMypageController@index");
    }

    $scoringTerms = ScoringTermsClass::scoringTerms();
    $scoringSignals = ScoringTermsClass::scoringSignals();
    return view("hr/interview/scoring/form_confirm",compact('input', 'scoringTerms', 'scoringSignals'));
  }

  function send(Request $request){
    //セッションから値を取り出す
    $input = $request->session()->get("form_input");

    //戻るボタンが押された時
    if($request->has("back")){
      return redirect()->action("Hr_HrMypageController@index")
        ->withInput($input);
    }

    //セッションに値が無い時はフォームに戻る
    if(!$input){
      return redirect()->action("Hr_HrMypageController@index");
    }

    //=====処理内容====================================
    $interview = Interview::find($input['interview_id']);

    $questions = Question::get();

    for ($index = 1; $index <= 3; $index++) {
      $questionData = Question::where('name', $input['question-'.$index]);
      $questionData->increment('times');
      $questionId = $questions->where('name', $input['question-'. $index])->first()->id;
      $questionColumn = 'question_'. $index. '_id';
      $interview->$questionColumn = $questionId;
    }

    $interview->available = config('const.INTERVIEW.DONE');

    for ($index = 1; $index <= 10; $index++) {
      $scoreColumn = 'score_'. $index;
      $interview->$scoreColumn = $input['term'.$index];
    }

    $interview->review_good = $input['review-good'];
    $interview->review_more = $input['review-more'];

    $interview->save();

    $stUser = User::find($interview->st_id);
    $stUser->status = config('const.USER_STATUS.AVAILABLE');
    $stUser->save();

    $hrUser = HrUser::find($interview->hr_id);
    $hrUser->status = config('const.USER_STATUS.AVAILABLE');
    $hrUser->save();
    //================================================

    if(!is_null($stUser->line_id)){
      $this->lineNotification($stUser);
    }

    //セッションを空にする
    $request->session()->forget("form_input");

    return redirect()->action("Hr_ScoringController@complete");
  }

  function complete(){
    //昨日以前のbattingテーブルのデータを削除する
    $yesterday = new DateTime('-1 day');
    $targets = Batting::where('date', '<', $yesterday)->get();

    foreach($targets as $target){
      $target->delete();
    }

    return view("hr/interview/scoring/form_complete");
  }

  public function lineNotification($st) { // LINE通知する関数
    //本会員登録リンク 送信部分
    $http_client = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($this->access_token);
    $bot         = new \LINE\LINEBot($http_client, ['channelSecret' => $this->channel_secret]);

    $builder = new \LINE\LINEBot\MessageBuilder\MultiMessageBuilder();
    // ビルダーにメッセージをすべて追加
    $imageUrl = "";
    $msgs = [
        new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($st->nickname."さん、面接お疲れ様でした！\n面接での感想や学びをTwitterで発信すると、Amazonギフト券がもらえるキャンペーンを行っています！\n詳細は下記ポスターよりご確認ください！"),
        new \LINE\LINEBot\MessageBuilder\TextMessageBuilder("（運営からのひとこと）\nまだまだ参加者が少ないので、1万円もらえる可能性大です！"),
        new \LINE\LINEBot\MessageBuilder\ImageMessageBuilder($imageUrl, $imageUrl),
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
