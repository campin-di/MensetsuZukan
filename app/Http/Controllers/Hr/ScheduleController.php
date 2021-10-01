<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

use App\Models\User;
use App\Models\HrUser;
use App\Models\Schedule;
use App\Models\Interview;
use App\Models\Batting;
use App\Models\Message;

use Illuminate\Support\Facades\Mail;
use Log;

use App\Common\GoogleSheetClass;
use App\Common\MeetingClass;
use App\Common\ReturnUserInformationArrayClass;

class ScheduleController extends Controller
{
  protected $access_token;
  protected $channel_secret;

  public function __construct()
  {
      // :point_down: アクセストークン
      $this->access_token = env('LINE_ACCESS_TOKEN');
      // :point_down: チャンネルシークレット
      $this->channel_secret = env('LINE_CHANNEL_SECRET');
  }

  public function schedule($stId)
  {
    Schedule::where('date', '<', date('Y-n-j'))->delete();

    $st = User::where('id', $stId)->select('id', 'nickname')->first();

    $timeArray = ReturnUserInformationArrayClass::returnTimeArray();
    
    return view('hr/interview/schedule/form', compact('st','timeArray'));
  }

  public function post(Request $request)
  {
    $input = $request->all();

    //セッションに書き込む
    $request->session()->put("form_input", $input);

    return redirect()->action("Hr\ScheduleController@confirm");
  }

  function confirm(Request $request){
    //セッションから値を取り出す
    $input = $request->session()->get("form_input");

    //セッションに値が無い時はフォームに戻る
    if(!$input){
      return redirect()->action("Hr\ChatController@list");
    }

    $timeArray = ReturnUserInformationArrayClass::returnTimeArray();

    $date = $input['date'];
    $time = $timeArray[$input['time']];

    return view('hr/interview/schedule/form_confirm', compact('date', 'time'));
  }

  function send(Request $request){
    //セッションから値を取り出す
    $input = $request->session()->get("form_input");

    //戻るボタンが押された時
    if($request->has("back")){
      return redirect()->action("Hr\ChatController@list")->withInput($input);
    }

    //セッションに値が無い時はフォームに戻る
    if(!$input){
      return redirect()->action("Hr\ChatController@list");
    }

    //必要データの定義・呼び出し
    $st = User::find($input['stId']);
    $hr = HrUser::find(Auth::guard('hr')->id());

    $date = $input['date'];
    $timeKey = $input['time'];
    
    $timeArray = ReturnUserInformationArrayClass::returnTimeArray();

    $duplicateNum = Interview::where('date', $date)->where('time', $timeArray[$timeKey])->count();

    $duplicateFlag = FALSE;
    if($duplicateNum != 0) {
      $duplicateFlag = TRUE;
      
      return view('hr/interview/schedule/form_complete', compact('duplicateFlag'));
    }
    
    //面接リンクの発行
    $meeting = new MeetingClass();
    $created_meeting = $meeting->createMeeting(0, $date, $timeKey);

    $interview = new Interview;
    $interview->st_id = $st->id;
    $interview->hr_id = $hr->id;
    $interview->date = $date;
    $interview->time = $timeArray[$timeKey];
    $interview->zoomUrl = $created_meeting['join_url'];
    $interview->zoomId = $created_meeting['id'];
    $interview->zoomPass = $created_meeting['password'];
    $interview->available = config('const.INTERVIEW.UNAVAILABLE');
    $interview->save();

    $this->recordInSpreadsheet($st, $hr, $interview);
    $this->lineNotification($st, $hr);

    // メッセージに自動送信 
    $requestDate = "・9月28日：20:30〜21:00";
    $autoMessage = "※本メッセージは自動配信です。\n\n".$hr->nickname."さんと、下記の日程での模擬面接の実施が決定しました！\n\n". $requestDate. "\n\nその他、模擬面接に関する詳細情報は、マイページ「面接予定」よりご確認ください。\n"."面接日程がどうしても合わなくなった場合は、".$hr->nickname."さんに事情を伝え、面接日程を変更してもらってください。\n\nこのメッセージへの返信は不要です。";

    $today = date("n/j");
    $now = date("G:i");

    $message = new Message;
    $message->st_id = $st->id;
    $message->hr_id = $hr->id;
    $message->sender = 1;
    $message->date = $today;
    $message->time = $now;
    $message->body = $autoMessage;
    $message->save();

    //セッションを空にする
    $request->session()->forget("form_input");
    
    return view('hr/interview/schedule/form_complete', compact('duplicateFlag'));
  }

  public function recordInSpreadsheet($st, $hr, $interview) { // 面接予約をスプレッドシートに記入する関数
    $responsibility = '木原';

    $sheets = GoogleSheetClass::instance();
    $sheet_id = '1QFSHSQxUnfzYkAg7L3XtaqeWd1zJFAael_xnYoc8Kmc';

    $appointment = [
      $interview->id,
      $st->name. '（'. $st->nickname. '）',
      $hr->name. '（'. $hr->nickname. '）',
      $hr->company,
      $interview->date,
      $interview->time,
      $responsibility,
      $interview->zoomUrl,
      $interview->zoomId,
      $interview->zoomPass,
      0
    ];

    $values = new \Google_Service_Sheets_ValueRange();
    $values->setValues([
        'values' => $appointment
    ]);
    $params = ['valueInputOption' => 'USER_ENTERED'];
    $sheets->spreadsheets_values->append(
        $sheet_id,
        '面接予定表!A4',
        $values,
        $params
    );
  }

  public function lineNotification($st, $hr) { // 面接予約時にLINE通知する関数
    //本会員登録リンク 送信部分
    $http_client = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($this->access_token);
    $bot         = new \LINE\LINEBot($http_client, ['channelSecret' => $this->channel_secret]);

    $builder = new \LINE\LINEBot\MessageBuilder\MultiMessageBuilder();
    // ビルダーにメッセージをすべて追加
    $msgs = [
        new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('面接日程が決定しました！'),
        new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('トーク画面右下の「マイページ」より面接図鑑にログインし、「面接予定」から面接の詳細情報をご確認ください。'),
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
