<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Common\CutStringClass;

use App\Models\Hr_profile;
use App\Models\Interview;
use App\Models\Question;

class Hr_InterviewController extends Controller
{
  public function preStart($id)
  {
    $interviewInfo = Interview::with('hr_user')->find($id);

    return view('hr/interview/pre_start', [
      'interviewInfo' => $interviewInfo,
    ]);
  }

  public function search()
  {
    $hrs = Hr_profile::with('hr_user')->get();

    $hrCollection = collect([]);
    foreach ($hrs as $hr) {
      $hrCollection = $hrCollection->concat([
        [
          'name' => $hr->hr_user->name,
          'introduction' => CutStringClass::CutString($hr->introduction, 40),
        ],
      ]);
    }

    return view('hr/interview/search', [
      'hrCollection' => $hrCollection,
    ]);
  }

  //== 質問リスト作成 関係　=======================================================
  private $formItems = ["name", "title", "body"];

  private $validator = [
    /*
    "name" => "required|string|max:100",
    "title" => "required|string|max:100",
    "body" => "required|string|max:100"
    */
  ];

  public function add($id)
  {
    $questions = Question::get();

    return view('hr/interview/question/add',[
      'id' => $id,
      'questions' => $questions,
    ]);
  }

  public function post(Request $request)
  {

    $input = $request->all();

    //=====部分処理====================================
/*
    $validator = Validator::make($input, $this->validator);
    if($validator->fails()){
      return redirect()->action("Hr_InterviewController@show")
        ->withInput()
        ->withErrors($validator);
    }
*/
    //================================================

    //セッションに書き込む
    $request->session()->put("form_input", $input);

    return redirect()->action("Hr_InterviewController@confirm");
  }

  function confirm(Request $request){
    //セッションから値を取り出す
    $input = $request->session()->get("form_input");

    //セッションに値が無い時はフォームに戻る
    if(!$input){
      return redirect()->action("Hr_InterviewController@add");
    }
    return view("hr/interview/question/form_confirm",['input' => $input]);
  }

  function send(Request $request){
    //セッションから値を取り出す
    $input = $request->session()->get("form_input");

    //戻るボタンが押された時
    if($request->has("back")){
      return redirect()->action("Hr_InterviewController@add")
        ->withInput($input);
    }

    //セッションに値が無い時はフォームに戻る
    if(!$input){
      return redirect()->action("Hr_InterviewController@add");
    }

    //=====処理内容====================================
    $interview = Interview::find($input['interview_id']);

    for ($index = 1; $index <= 6; $index++) {
      $questionData = Question::where('name', $input['question-'.$index]);
      $questionData->increment('times');

      $questionId = 'question_'. $index. '_id';

      $interview->$questionId = $questionData->first()->id;
      $interview->available = 1;
    }
    $interview->save();
    //================================================

    //セッションを空にする
    $request->session()->forget("form_input");

    return redirect()->action("Hr_InterviewController@complete");
  }

  function complete(){
    return view("hr/interview/question/form_complete");
  }


}
