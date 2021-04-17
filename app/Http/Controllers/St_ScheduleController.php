<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Models\HrUser;
use App\Models\Schedule;
use App\Models\Interview;
use App\Models\Batting;

use App\Common\MeetingClass;

class St_ScheduleController extends Controller
{
  public function schedule($hr_id)
  {
    $hrUser = HrUser::where('id', $hr_id)->select('id', 'name', 'username')->first();
    $scheduleData = Schedule::where('hr_id', $hr_id);

    if(!$scheduleData->exists()){
      $is_schedule = 0;
      return view('interview/schedule/form', [
        'hrUser' => $hrUser,
        'is_schedule' => $is_schedule,
      ]);
    } else {
      $schedules = $scheduleData->get();
      $is_schedule = 1;
    }

    $timeArray = [
      'nine' => "9:00 - 10:00",
      'ten' => "10:00 - 11:00",
      'eleven' => "11:00 - 12:00",
      'twelve' => "12:00 - 13:00",
      'thirteen' => "13:00 - 14:00",
      'fourteen' => "14:00 - 15:00",
      'fifteen' => "15:00 - 16:00",
      'sixteen' => "16:00 - 17:00",
      'seventeen' => "17:00 - 18:00",
      'eighteen' => "18:00 - 19:00",
      'nineteen' => "19:00 - 20:00",
      'twenty' => "20:00 - 21:00",
      'twentyone' => "21:00 - 22:00"
    ];

    return view('interview/schedule/form', [
      'hrUser' => $hrUser,
      'schedules' => $schedules,
      'timeArray' => $timeArray,
      'is_schedule' => $is_schedule,
    ]);
  }

  public function post(Request $request)
  {
    $input = $request->all();

    //=====部分処理====================================
/*
    $validator = Validator::make($input, $this->validator);
    if($validator->fails()){
      return redirect()->action("St_ScheduleController@show")
        ->withInput()
        ->withErrors($validator);
    }
*/
    //================================================

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
    return view("interview/schedule/form_confirm",['input' => $input]);
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
    $timeArray = [
      'nine' => "9:00 - 10:00",
      'ten' => "10:00 - 11:00",
      'eleven' => "11:00 - 12:00",
      'twelve' => "12:00 - 13:00",
      'thirteen' => "13:00 - 14:00",
      'fourteen' => "14:00 - 15:00",
      'fifteen' => "15:00 - 16:00",
      'sixteen' => "16:00 - 17:00",
      'seventeen' => "17:00 - 18:00",
      'eighteen' => "18:00 - 19:00",
      'nineteen' => "19:00 - 20:00",
      'twenty' => "20:00 - 21:00",
      'twentyone' => "21:00 - 22:00"
    ];

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
    return view("interview/schedule/form_complete");
  }

}