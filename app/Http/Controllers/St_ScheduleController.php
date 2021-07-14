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

use App\Common\MeetingClass;
use App\Common\ReturnUserInformationArrayClass;

class St_ScheduleController extends Controller
{
  public function schedule($hr_id)
  {
    Schedule::where('date', '<', date('Y-m-d'))->delete();

    $hrUser = HrUser::where('id', $hr_id)->select('id', 'nickname', 'company', 'image_path', 'industry')->first();
    $scheduleData = Schedule::orderBy('date', 'asc')->where('hr_id', $hr_id);

    if(!$scheduleData->exists()){
      $is_schedule = 0;
      return view('st/interview/schedule/form', [
        'hrUser' => $hrUser,
        'is_schedule' => $is_schedule,
      ]);
    } else {
      $schedules = $scheduleData->get();
      $is_schedule = 1;
    }

    $timeArray = ReturnUserInformationArrayClass::returnTimeArray();

    return view('st/interview/schedule/form', [
      'hrUser' => $hrUser,
      'schedules' => $schedules,
      'timeArray' => $timeArray,
      'is_schedule' => $is_schedule,
    ]);
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

    return view('st/interview/schedule/form_confirm', compact('date', 'time'));
  }

  function send(Request $request){
    //セッションから値を取り出す
    $input = $request->session()->get("form_input");
    foreach ($input as $key => $schedule) {
      $isDateFormat = preg_match('/\A[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}\z/', $key);
      if($isDateFormat && !is_null($schedule)) {
        $explode = explode(':', $schedule);
        $date = $explode[0];
        $timeKey = $explode[1];
      }
    }

    $schedule = Schedule::where('hr_id', $input['hr_id'])->where('date', $date)->get();
    $schedule = $schedule[0];

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

    $hr_id = $schedule->hr_id;
    $st = User::find(Auth::user()->id);
    $hr = HrUser::find($hr_id);

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
            $timeKey => 0,
          ]);
        }
      }
      $created_meeting = $meeting->createMeeting($batting->api_user, $date, $timeKey);

    } else {
      $newBatting = new Batting;
      $newBatting->date = $date;
      $newBatting->time = $timeKey;
      $newBatting->api_user = 0;
      $newBatting->save();

      $created_meeting = $meeting->createMeeting($newBatting->api_user, $date, $timeKey);
    }

    $interview = new Interview;
    $interview->st_id = $st->id;
    $interview->hr_id = $hr_id;
    $interview->date = $date;
    $interview->time = $timeArray[$timeKey];
    $interview->zoomUrl = $created_meeting['join_url'];
    $interview->zoomId = $created_meeting['id'];
    $interview->zoomPass = $created_meeting['password'];
    $interview->available = config('const.INTERVIEW.UNAVAILABLE');
    $interview->save();

    \DB::table('schedules')->where('id', $schedule->id)->update([
      $timeKey => 0,
    ]);

    Mail::send('st/interview/schedule/mail/reservation', ['interview' => $interview, 'hr' => $hr, 'st' => $st],
      function ($message) use ($hr, $st){
        $message->subject($st->name. 'さんから面接予約がありました！');
        $message->from('mensetsuzukan@pampam.co.jp', '面接図鑑');
        $message->to($hr->email);
      }
    );
    //================================================

    //セッションを空にする
    $request->session()->forget("form_input");

    return redirect()->action("St_ScheduleController@complete");
  }

  function complete(){
    return view('st/interview/schedule/form_complete');
  }

}
