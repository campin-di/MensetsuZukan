<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\HrUser;
use App\Models\Schedule;
use App\Models\Interview;
use App\Models\Batting;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Log;

use App\Common\IsBoolClass;
use App\Common\ReturnUserInformationArrayClass;
use App\Common\CutStringClass;
use App\Common\MeetingClass;
use App\Common\GoogleSheetClass;

class Hr_ScheduleController extends Controller
{
  public function __construct()
  {
      // :point_down: アクセストークン
      $this->access_token = env('LINE_ACCESS_TOKEN');
      // :point_down: チャンネルシークレット
      $this->channel_secret = env('LINE_CHANNEL_SECRET');
  }

  public function request()
  {
    $userId = Auth::guard('hr')->id();
    $requests = Schedule::where('hr_id', $userId)->select('st_id')->groupBy('st_id')->with('st_user:id,nickname,industry,university_class,image_path,introduction,company_type')->get();

    $stCollection = collect([]);
    foreach ($requests as $request) {
      $stUser = $request->st_user;
      $stCollection = $stCollection->concat([
        [
          'id' => $stUser->id,
          'nickname' => $stUser->nickname,
          'imagePath' => $stUser->image_path,
          'companyType' => $stUser->company_type,
          'industry' => $stUser->industry,
          'universityClass' => $stUser->university_class,
          'introduction' => CutStringClass::CutString($stUser->introduction, 105),
        ],
      ]);
    }

    return view('hr/interview/schedule/request_list', compact('stCollection'));
  }
  
  public function form($st_id)
  {
    $timeArray = ReturnUserInformationArrayClass::returnTimeArray();
    $timeColumns = ReturnUserInformationArrayClass::returnTimeColumns();

    $userId = Auth::guard('hr')->id();
    $schedules = Schedule::where('hr_id', $userId)->with('st_user:id,nickname,industry,university_class,image_path,introduction,company_type')->whereHas('st_user', function($q) use ($st_id){
      $q->where('id', $st_id);
    })->get();

    $scheduleCollection = collect([]);
    foreach($schedules as $schedule){
      $tmpArray = [];
      foreach($timeColumns as $key => $item){
        if($schedule->$key == 1){
          $tmpArray += [$key => $timeArray[$key]];
        } elseif($schedule->$key == 2){
          $tmpArray += [$key.'_h' => $timeArray[$key.'_h']];
        } elseif($schedule->$key == 3){
          $tmpArray += [$key => $timeArray[$key]];
          $tmpArray += [$key.'_h' => $timeArray[$key.'_h']];
        }
      }

      $scheduleCollection = $scheduleCollection->put($schedule->date, $tmpArray);
    }    

    return view('hr/interview/schedule/form', compact('scheduleCollection', 'schedules', 'st_id'));
  }

  public function post(Request $request)
  {
    $input = $request->all();
    $request->session()->put("form_input", $input);

    return redirect()->action("Hr_ScheduleController@confirm");
  }

  function confirm(Request $request){
    //セッションから値を取り出す
    $input = $request->session()->get("form_input");

    //セッションに値が無い時はフォームに戻る
    if(!$input){
      return redirect()->action("Hr_ScheduleController@form");
    }
    
    if($input['none'] == 'none'){
      $flag = TRUE;
      return view("hr/interview/schedule/form_confirm", compact('flag'));
    }

    foreach ($input as $key => $schedule) {
      $isDateFormat = preg_match('/\A[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}\z/', $key);
      if($isDateFormat && !is_null($schedule)) {
        $explode = explode(':', $schedule);
        $date = $explode[0];
        $timeKey = $explode[1];
      }
    }

    $timeArray = ReturnUserInformationArrayClass::returnTimeArray();
    foreach ($timeArray as $key => $value) {
      if($key == $timeKey){
        $time = $value;
      }
    }
    $flag = 0;
    return view("hr/interview/schedule/form_confirm", compact('date', 'time', 'flag'));
  }

  function send(Request $request){
    //セッションから値を取り出す
    $input = $request->session()->get("form_input");

    //戻るボタンが押された時
    if($request->has("back")){
      return redirect()->action("Hr_ScheduleController@form")
        ->withInput($input);
    }

    //セッションに値が無い時はフォームに戻る
    if(!$input){
      return redirect()->action("Hr_ScheduleController@form");
    }

    //=====処理内容====================================
    $hr_id = Auth::guard('hr')->id();
    $hr = HrUser::find($hr_id);

    $st_id = $input['st_id'];
    $st = User::find($st_id);

    if($input['none'] == 'none'){
      $flag = 0;

      //学生と人事の組み合わせに該当するスケジュールデータを削除
      $schedule = Schedule::where('hr_id', $hr_id)->where('st_id', $st_id)->delete();
    } else {
      $flag = 1;
      foreach ($input as $key => $schedule) {
        $isDateFormat = preg_match('/\A[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}\z/', $key);
        if($isDateFormat && !is_null($schedule)) {
          $explode = explode(':', $schedule);
          $date = $explode[0];
          $timeKey = $explode[1];

          $tmp = explode('_', $timeKey);
          $dbKey = $tmp[0];
        }
      }

      //学生と人事の組み合わせに該当するスケジュールデータを削除
      $schedule = Schedule::where('hr_id', $hr_id)->where('st_id', $st_id)->delete();

      $meeting = new MeetingClass();
      $battingData = Batting::where('date', $date)->where('time', $timeKey);
      
      if($battingData->exists()){
        $batting = $battingData->get();
        $batting = $batting[0];
        $batting->increment('api_user');
        //api_userが1(2人分:0と1)になったら全てのスケジュール内の日と時間をゼロにする。
        if($batting->api_user == 1){
          $targetSchedules = Schedule::where('date', $batting->date)->get();
          foreach ($targetSchedules as $eachSchedule) {
            \DB::table('schedules')->where('id', $eachSchedule->id)->update([
              $dbKey => 0,
            ]);
          }
        }
        $created_meeting = $meeting->createMeeting($batting->api_user, $date, $timeKey);
        
      } else {
        $batting = new Batting;
        $batting->date = $date;
        $batting->time = $timeKey;
        $batting->api_user = 0;
        $batting->save();
        
        $created_meeting = $meeting->createMeeting($batting->api_user, $date, $timeKey);
      }
      
      $timeArray = ReturnUserInformationArrayClass::returnTimeArray();

      $interview = new Interview;
      $interview->st_id = $st_id;
      $interview->hr_id = $hr_id;
      $interview->date = $date;
      $interview->time = $timeArray[$timeKey];
      $interview->zoomUrl = $created_meeting['join_url'];
      $interview->zoomId = $created_meeting['id'];
      $interview->zoomPass = $created_meeting['password'];
      $interview->available = config('const.INTERVIEW.UNAVAILABLE');
      $interview->save();
      
      /* === スプシに記入する処理 =========================*/
      $responsibility = '木原';
      if($batting->api_user != 0){
        $responsibility = 'ゴダール';
      }

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
      /* === end :スプシに記入する処理 =========================*/
    }

    /* === start :学生への面接予約完了通知 =========================*/
    //本会員登録リンク 送信部分
    $http_client = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($this->access_token);
    $bot         = new \LINE\LINEBot($http_client, ['channelSecret' => $this->channel_secret]);

    $builder = new \LINE\LINEBot\MessageBuilder\MultiMessageBuilder();
    // ビルダーにメッセージをすべて追加
    if($flag == 1){
      $msgs = [
          new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('面接リクエストが承認されました！'),
          new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('トーク画面右下の「マイページ」より面接図鑑にログインし、「面接予定」から面接に関する詳細情報をご確認ください。'),
      ];
    } else {
      $msgs = [
        new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('リクエストしていただいた候補日と面接官の予定が合わなかったため、面接リクエストが却下されました。'),
        new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('トーク画面右下の「マイページ」より面接図鑑にログインし、「現役人事と面接練習！」から別の日程で面接リクエストを送信してください！'),
      ];
    }
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

    //セッションを空にする
    $request->session()->forget("form_input");

    return redirect()->action("Hr_ScheduleController@complete");
  }

  function complete(){
    return view("hr/interview/schedule/form_complete");
  }
}
