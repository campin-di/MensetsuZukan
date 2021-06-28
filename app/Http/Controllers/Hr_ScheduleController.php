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

    $schedule = new Schedule;
    $schedule->hr_id = $userId;
    $schedule->date = $input['date'];
    foreach ($timeArray as $key => $time) {
      $schedule->$key = IsBoolClass::IsBool($key, $input['time']);
    }
    $schedule->save();

    //================================================

    //セッションを空にする
    $request->session()->forget("form_input");

    return redirect()->action("Hr_ScheduleController@complete");
  }

  function complete(){
    return view("hr/interview/schedule/form_complete");
  }
}
