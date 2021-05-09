<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Models\HrUser;
use App\Models\Schedule;
use App\Models\Interview;
use App\Models\Batting;

use App\Common\MeetingClass;
use App\Common\ReturnTimeArrayClass;

class St_ScheduleController extends Controller
{
  public function schedule($hr_id)
  {
    $hrUser = HrUser::where('id', $hr_id)->select('id', 'name')->first();
    $scheduleData = Schedule::where('hr_id', $hr_id);

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

    $timeArray = ReturnTimeArrayClass::returnTimeArray();

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

    $date = $input['date'];

    $timeArray = ReturnTimeArrayClass::returnTimeArray();
    foreach ($timeArray as $key => $value) {
      if($key == $input['time']){
        $time = $value;
      }
    }

    return view('st/interview/schedule/form_confirm', compact('date', 'time'));
  }

  function send(Request $request){
    //セッションから値を取り出す
    $input = $request->session()->get("form_input");
    $date = $input['date'];

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
    $timeArray = ReturnTimeArrayClass::returnTimeArray();

    $hr_id = $schedule->hr_id;

    $meeting = new MeetingClass();
    $time = $input['time'];
    $battingData = Batting::where('date', $date)->where('time', $time);

    if($battingData->exists()){
      $batting = $battingData->get();
      $batting = $batting[0];
      $batting->increment('api_user');
      //api_userが1(2人分:0と1)になったら全てのスケジュール内の日と時間をゼロにする。
      if($batting->api_user == 1){
        $targetSchedules = Schedule::where('date', $batting->date)->get();
        foreach ($targetSchedules as $eachSchedule) {
          \DB::table('schedules')->where('id', $eachSchedule->id)->update([
            $time => 0,
          ]);
        }
      }
      $created_meeting = $meeting->createMeeting($batting->api_user, $date, $time);

    } else {
      $newBatting = new Batting;
      $newBatting->date = $date;
      $newBatting->time = $time;
      $newBatting->api_user = 0;
      $newBatting->save();

      $created_meeting = $meeting->createMeeting($newBatting->api_user, $date, $time);
    }

    $interview = new Interview;
    $interview->st_id = Auth::user()->id;
    $interview->hr_id = $hr_id;
    $interview->date = $date;
    $interview->time = $timeArray[$time];
    $interview->password = $created_meeting['password'];
    $interview->url = $created_meeting['join_url'];
    $interview->available = 0;
    $interview->save();

    \DB::table('schedules')->where('id', $schedule->id)->update([
      $time => 0,
    ]);
    //================================================

    //セッションを空にする
    $request->session()->forget("form_input");

    return redirect()->action("St_ScheduleController@complete");
  }

  function complete(){
    return view('st/interview/schedule/form_complete');
  }

}
