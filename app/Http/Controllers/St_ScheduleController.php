<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Models\User;
use App\Models\HrUser;
use App\Models\Schedule;
use App\Models\Interview;
use App\Models\Batting;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Log;

use App\Common\GoogleSheetClass;
use App\Common\MeetingClass;
use App\Common\ReturnUserInformationArrayClass;

class St_ScheduleController extends Controller
{
  public function __construct()
  {
      // :point_down: アクセストークン
      $this->access_token = env('LINE_ACCESS_TOKEN');
      // :point_down: チャンネルシークレット
      $this->channel_secret = env('LINE_CHANNEL_SECRET');
  }

  public function schedule($hr_id)
  {
    Schedule::where('date', '<', date('Y-n-j'))->delete();

    $hrUser = HrUser::where('id', $hr_id)->select('id', 'nickname', 'company', 'image_path', 'industry')->first();
    $scheduleData = Schedule::orderBy('date', 'asc')->where('hr_id', $hr_id);
    
    $tommorow = date('Y-m-d', strtotime('+1 day'));
    $scheduleData->where('date', $tommorow)->delete();

    $timeArray = ReturnUserInformationArrayClass::returnTimeArray();
    
    return view('st/interview/schedule/form', compact('hrUser','timeArray'));
  }

  public function post(Request $request)
  {
    $input = $request->all();

    //セッションに書き込む
    $request->session()->put("form_input", $input);

    return redirect()->action("St_ScheduleController@confirm");
  }

  function confirm(Request $request){
    //セッションから値を取り出す
    $input = $request->session()->get("form_input");

    //セッションに値が無い時はフォームに戻る
    if(!$input){
      return redirect()->action("St_InterviewController@search");
    }
    $timeArray = ReturnUserInformationArrayClass::returnTimeArray();

    return view('st/interview/schedule/form_confirm', compact('input', 'timeArray'));
  }

  // $timeKeyArray : 入力されたタイムキーの配列
  // $target : 追加or変更するScheduleデータ
  public function setTimeNumber($timeKeyArray, $target, $hr_id, $date) {
    $newTimeKeyArray = []; //他の人事とのスケジュールに同日程の予定があった場合を除くタイムキー配列
    foreach($timeKeyArray as $timeKey){
      $battingData = Batting::where('date', $date)->where('time', $timeKey);
      if(!$battingData->exists()){
        $timeArray = explode('_', $timeKey);
        $alreadySchedule = Schedule::where('hr_id', '!=', $hr_id)->where('date', $date)->where($timeArray[0], '>', 0)->first();
        if(!is_null($alreadySchedule)){
          $tmpTimeKey = $timeArray[0];
          $val = $alreadySchedule->$tmpTimeKey;
          if(array_key_exists(1, $timeArray) && $timeArray[1] == 'h'){
            if($val == 1) {
              array_push($newTimeKeyArray, $timeKey);
            }
          } else {
            if($val == 2) {
              array_push($newTimeKeyArray, $timeKey);
            }
          }
        } else {
          array_push($newTimeKeyArray, $timeKey);
        }
      }
    }

    if(empty($newTimeKeyArray)){
      return $newTimeKeyArray;
    }

    foreach ($newTimeKeyArray as $time) {
      $time = explode('_', $time);

      $time_key = $time[0];
      if(array_key_exists(1, $time) && $time[1] == 'h'){
        if($target->$time_key % 2 == 1){
          $target->$time_key = 3;
        } else {
          $target->$time_key = 2;
        }
      } else {
        //キーがhogeの形のとき
        if($target->$time_key >= 2){
          $target->$time_key = 3;
        } else{
          $target->$time_key = 1;
        }
      }
    }

    return $newTimeKeyArray;
  }

  function send(Request $request){
    //セッションから値を取り出す
    $input = $request->session()->get("form_input");
    //戻るボタンが押された時
    if($request->has("back")){
      return redirect()->action("St_InterviewController@search")->withInput($input);
    }

    //セッションに値が無い時はフォームに戻る
    if(!$input){
      return redirect()->action("St_InterviewController@search");
    }

    //=====処理内容====================================
    $timeArray = ReturnUserInformationArrayClass::returnTimeArray();
    $timeColumns = ReturnUserInformationArrayClass::returnTimeColumns();

    $hr_id = $input['hr_id'];
    $hr = HrUser::find($hr_id);

    $st_id = Auth::user()->id;
    $st = User::find($st_id);

    $date = $input['date'];

    $schedule = Schedule::where('st_id', $st_id);
    
    $target = $schedule->where('hr_id', $hr_id)->where('date', $date);
    if($target->exists()){
      $target = $target->first();

      $newTimeKeyArray = $this->setTimeNumber($input['time'], $target, $hr_id, $date);
    } else{
      $target = new Schedule;
      $target->hr_id = $hr_id;
      $target->st_id = $st_id;
      $target->date = $date;

      //キーが存在しなかったカラムを0で埋める。
      foreach ($timeColumns as $key => $column) {
        $target->$key = 0;
      }
      $newTimeKeyArray = $this->setTimeNumber($input['time'], $target, $hr_id, $date);
    }

    $flag = 1;
    if(empty($newTimeKeyArray)){
      $flag = 0;
    }

    if($flag == 1){
      /* === start :学生への面接リクエスト完了通知 =========================*/
      //本会員登録リンク 送信部分
      $http_client = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($this->access_token);
      $bot         = new \LINE\LINEBot($http_client, ['channelSecret' => $this->channel_secret]);

      $builder = new \LINE\LINEBot\MessageBuilder\MultiMessageBuilder();
      // ビルダーにメッセージをすべて追加
      $msgs = [
          new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('面接リクエストを送信しました！'),
          new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('マイページ情報を充実させると、リクエストの受諾率がアップします！トーク画面左下「マイページ」より、マイページ情報を充実させましょう！'),
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

      $target->save();
      
      $mailDateArray = [
        "date" => $date,
        "time" => [],
      ];
      
      foreach($newTimeKeyArray as $timeKey){
        array_push($mailDateArray['time'], $timeArray[$timeKey]);
      }
        
      Mail::send('st/interview/schedule/mail/reservation', ['mailDateArray' => $mailDateArray, 'hr' => $hr, 'st' => $st],
        function ($message) use ($hr, $st){
          $message->subject($st->nickname. 'さんから面接リクエストがありました！');
          $message->from('mensetsuzukan@pampam.co.jp', '面接図鑑');
          $message->to($hr->email);
        }
      );
    }
    //================================================
    
    $lineFlag = is_null($st->line_id);
    echo $lineFlag;
    //セッションを空にする
    $request->session()->forget("form_input");

    return view('st/interview/schedule/form_complete', compact('flag', 'lineFlag'));
  }

  public function check()
  {
    $timeColumns = ReturnUserInformationArrayClass::returnTimeColumns();
    $timeArray = ReturnUserInformationArrayClass::returnTimeArray();

    $userId = Auth::user()->id;
    $addTimeArray = Schedule::where('st_id', $userId)->orderBy('date', 'asc')->get();

    $scheduleArray = [];
    foreach($addTimeArray as $addTime){
      $dayArray = [];
      foreach($timeColumns as $key => $val){
        if($addTime->$key == 0){
          continue;
        } elseif($addTime->$key == 1) {
          $dayArray += [$key => $timeArray[$key]];
        } elseif($addTime->$key == 2) {
          $dayArray += [$key.'_h' => $timeArray[$key.'_h']];
        } else {
          $dayArray += [$key => $timeArray[$key]];
          $dayArray += [$key.'_h' => $timeArray[$key.'_h']];
        }
      }
      if(array_key_exists($addTime->date, $scheduleArray)){
        $scheduleArray[$addTime->date] = array_merge($scheduleArray[$addTime->date], $dayArray);
      } else {
        $scheduleArray += [$addTime->date => $dayArray];
      }
    }

    return view('st/interview/schedule/check', compact('scheduleArray'));
  }

  public function delete(Request $request)
  {
    $input = $request->all();
    $request->session()->put("form_input", $input);

    return redirect()->action("St_ScheduleController@deleteConfirm");
  }

  function deleteConfirm(Request $request){
    //セッションから値を取り出す
    $input = $request->session()->get("form_input");

    //セッションに値が無い時はフォームに戻る
    if(!$input){
      return redirect()->action("St_ScheduleController@check");
    }

    $timeArray = ReturnUserInformationArrayClass::returnTimeArray();

    $scheduleArray = [];
    foreach($input as $key => $array){
      if($key == 'schedule'){
        foreach($array as $schedule){
          $dates = explode(':', $schedule);
          $date = $dates[0];
          $hour = $dates[1];

          if(isset($scheduleArray[$date])){
            $scheduleArray[$date] = $scheduleArray[$date] .', '. $timeArray[$hour];
          }
          $scheduleArray += [$date => $timeArray[$hour]];
        }
      }
    }
    return view("st/interview/schedule/delete_confirm", compact('scheduleArray'));
  }

  function deleteSend(Request $request){
    //セッションから値を取り出す
    $input = $request->session()->get("form_input");
    
    //戻るボタンが押された時
    if($request->has("back")){
      return redirect()->action("St_ScheduleController@check")
        ->withInput($input);
    }

    //セッションに値が無い時はフォームに戻る
    if(!$input){
      return redirect()->action("St_ScheduleController@check");
    }

    //=====処理内容====================================
    $userId = Auth::user()->id;
    $timeArray = ReturnUserInformationArrayClass::returnTimeArray();

    $scheduleArray = [];
    foreach($input as $inputKey => $array){
      if($inputKey == 'schedule'){
        foreach($array as $schedule){
          $dates = explode(':', $schedule);
          $date = $dates[0];
          $key = $dates[1];

          $tmp = explode('_', $key);
          $dbKey = $tmp[0];

          // _h がない時flagは1
          $flag = FALSE;
          if(array_key_exists(1, $tmp)){
            $flag = TRUE;
            $target = Schedule::where('st_id', $userId)->where('date', $date)->where($dbKey, '>', 1)->first();
          } else {
            $target = Schedule::where('st_id', $userId)->where('date', $date)->where($dbKey, 1)->first();
          }

          if($target->$dbKey < 3){
            $target->$dbKey = 0;
          } else {
            if($flag == FALSE) {
              $target->$dbKey = 2;
            } else {
              $target->$dbKey = 1;
            }
          }
          $target->save();
        }
      }
    }

    //================================================

    //セッションを空にする
    $request->session()->forget("form_input");

    return redirect()->action("St_ScheduleController@deleteComplete");
  }

  function deleteComplete(){
    return view('st/interview/schedule/delete_complete');
  }

}
