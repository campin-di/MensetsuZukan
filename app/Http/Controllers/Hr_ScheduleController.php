<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use App\Models\Schedule;
use App\Models\HrUser;

use App\Common\IsBoolClass;
use App\Common\Add2DatabaseClass;

class Hr_ScheduleController extends Controller
{
  private $formItems = ["name", "title", "body"];

  private $validator = [
    /*
    "name" => "required|string|max:100",
    "title" => "required|string|max:100",
    "body" => "required|string|max:100"
    */
  ];

  public function add()
  {
    return view('hr/interview/schedule/add');
  }

  public function post(Request $request)
  {

    $input = $request->all();

    //=====部分処理====================================
/*
    $validator = Validator::make($input, $this->validator);
    if($validator->fails()){
      return redirect()->action("Hr_ScheduleController@show")
        ->withInput()
        ->withErrors($validator);
    }
*/
    //================================================

    //セッションに書き込む
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
    return view("hr/interview/schedule/form_confirm",['input' => $input]);
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
    $timeArray = ['eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen', 'twenty', 'twentyone'];

    $schedule = new Schedule;
    $schedule->hr_id = $userId;
    $schedule->date = $input['date'];
    foreach ($timeArray as $time) {
      $schedule->$time = IsBoolClass::IsBool($time, $input['time']);
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
