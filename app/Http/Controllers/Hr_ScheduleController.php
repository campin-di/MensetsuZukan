<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use App\Models\Schedule;
use App\Models\HrUser;

use App\Common\IsBoolClass;
use App\Common\ReturnUserInformationArrayClass;

class Hr_ScheduleController extends Controller
{
  public function add()
  {
    $timeArray = ReturnUserInformationArrayClass::returnTimeArray();

    return view('hr/interview/schedule/add', compact('timeArray'));
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
      return redirect()->action("Hr_ScheduleController@add");
    }

    $timeArray = ReturnUserInformationArrayClass::returnTimeArray();

    return view("hr/interview/schedule/form_confirm", compact('input', 'timeArray'));
  }

  function send(Request $request){
    //セッションから値を取り出す
    $input = $request->session()->get("form_input");

    //戻るボタンが押された時
    if($request->has("back")){
      return redirect()->action("Hr_ScheduleController@add")
        ->withInput($input);
    }

    //セッションに値が無い時はフォームに戻る
    if(!$input){
      return redirect()->action("Hr_ScheduleController@add");
    }

    //=====処理内容====================================
    $userId = Auth::guard('hr')->id();
    $timeArray = ReturnUserInformationArrayClass::returnTimeArray();
    $timeColumns = ReturnUserInformationArrayClass::returnTimeColumns();

    $target = Schedule::where('hr_id', $userId)->where('date', $input['date']);
    if($target->exists()){
      $schedule = $target->first();
      foreach ($input['time'] as $time) {
        $time = explode('_', $time);

        $time_key = $time[0];
        if(array_key_exists(1, $time) && $time[1] == 'h'){
          if($schedule->$time_key % 2 == 1){
            $schedule->$time_key = 3;
          } else{
            $schedule->$time_key = 2;
          }
        } else {
          if($schedule->$time_key >= 2){
            $schedule->$time_key = 3;
          } else{
            $schedule->$time_key = 1;
          }
        }
      }
    } else{
      $schedule = new Schedule;
      $schedule->hr_id = $userId;
      $schedule->date = $input['date'];
      foreach ($timeColumns as $key => $column) {
        if(in_array($key, $input['time'])){
          $schedule->$key = 1;
        } else{
          $schedule->$key = 0;
        }
      }

      foreach ($input['time'] as $time) {
        $time = explode('_', $time);

        $time_key = $time[0];
        if(array_key_exists(1, $time) && $time[1] == 'h'){
          if($schedule->$time_key % 2 == 1){
            $schedule->$time_key = 3;
          } else {
            $schedule->$time_key = 2;
          }
        }
      }
    }
    $schedule->save();

    //================================================
    //セッションを空にする
    $request->session()->forget("form_input");

    return redirect()->action("Hr_ScheduleController@complete");
  }

  public function check()
  {
    $timeColumns = ReturnUserInformationArrayClass::returnTimeColumns();
    $timeArray = ReturnUserInformationArrayClass::returnTimeArray();


    $userId = Auth::guard('hr')->id();
    $addTimeArray = Schedule::where('hr_id', $userId)->orderBy('date', 'asc')->get();

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

      $scheduleArray += [$addTime->date => $dayArray];
     }
    return view('hr/interview/schedule/check', compact('scheduleArray'));
  }

  public function delete(Request $request)
  {
    $input = $request->all();
    $request->session()->put("form_input", $input);

    return redirect()->action("Hr_ScheduleController@deleteConfirm");
  }

  function deleteConfirm(Request $request){
    //セッションから値を取り出す
    $input = $request->session()->get("form_input");

    //セッションに値が無い時はフォームに戻る
    if(!$input){
      return redirect()->action("Hr_ScheduleController@check");
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
    return view("hr/interview/schedule/delete_confirm", compact('scheduleArray'));
  }

  function deleteSend(Request $request){
    //セッションから値を取り出す
    $input = $request->session()->get("form_input");
    
    //戻るボタンが押された時
    if($request->has("back")){
      return redirect()->action("Hr_ScheduleController@check")
        ->withInput($input);
    }

    //セッションに値が無い時はフォームに戻る
    if(!$input){
      return redirect()->action("Hr_ScheduleController@check");
    }

    //=====処理内容====================================
    $userId = Auth::guard('hr')->id();
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
          }
          
          $target = Schedule::where('hr_id', $userId)->where('date', $date)->first();
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

    return redirect()->action("Hr_ScheduleController@complete");
  }


  function complete(){
    return view("hr/interview/schedule/form_complete");
  }
}
