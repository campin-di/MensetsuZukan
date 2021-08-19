<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Interview;
use App\Models\Question;

class Hr_QuestionListController extends Controller
{
  //== 質問リスト作成 関係　=======================================================

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

    //セッションに書き込む
    $request->session()->put("form_input", $input);

    return redirect()->action("Hr_QuestionListController@confirm");
  }

  function confirm(Request $request){
    //セッションから値を取り出す
    $input = $request->session()->get("form_input");

    //セッションに値が無い時はフォームに戻る
    if(!$input){
      return redirect()->action("Hr_QuestionListController@add");
    }
    return view("hr/interview/question/form_confirm",['input' => $input]);
  }

  function send(Request $request){
    //セッションから値を取り出す
    $input = $request->session()->get("form_input");

    //戻るボタンが押された時
    if($request->has("back")){
      return redirect()->action("Hr_QuestionListController@add")
        ->withInput($input);
    }

    //セッションに値が無い時はフォームに戻る
    if(!$input){
      return redirect()->action("Hr_QuestionListController@add");
    }

    //=====処理内容====================================
    $interview = Interview::find($input['interview_id']);

    for ($index = 1; $index <= 3; $index++) {
      $questionData = Question::where('name', $input['question-'.$index]);
      $questionId = 'question_'. $index. '_id';

      $interview->$questionId = $questionData->first()->id;
      $interview->available = 1;
    }
    $interview->save();
    //================================================

    //セッションを空にする
    $request->session()->forget("form_input");

    return redirect()->route('hr.interview.question.complete', [$interview->id]);

    //return redirect()->action('Hr_QuestionListController@complete', [$interview->id]);
  }

  function complete($id){

    return view('hr/interview/question/form_complete', compact('id'));
  }
  //====end : 登録===================================================================

  //== 質問リスト変更 関係　=======================================================
  private $editFormItems = ["name", "title", "body"];

  private $editValidator = [
    /*
    "name" => "required|string|max:100",
    "title" => "required|string|max:100",
    "body" => "required|string|max:100"
    */
  ];

  public function edit($id)
  {
    $questions = Question::get();
    $interview = Interview::with('question1:id,name')->with('question2:id,name')->with('question3:id,name')->find($id);
    $alreadyQuestionArray = [$interview->question1->name, $interview->question2->name, $interview->question3->name];

    return view('hr/interview/question/edit/edit',[
      'id' => $id,
      'questions' => $questions,
      'alreadyQuestionArray' => $alreadyQuestionArray,
    ]);
  }

  public function editPost(Request $request)
  {
    $input = $request->all();

    //=====部分処理====================================
  /*
    $editValidator = Validator::make($input, $this->editValidator);
    if($editValidator->fails()){
      return redirect()->action("Hr_QuestionListController@show")
        ->withInput()
        ->withErrors($editValidator);
    }
  */
    //================================================

    //セッションに書き込む
    $request->session()->put("form_input", $input);

    return redirect()->action("Hr_QuestionListController@editConfirm");
  }

  function editConfirm(Request $request){
    //セッションから値を取り出す
    $input = $request->session()->get("form_input");

    //セッションに値が無い時はフォームに戻る
    if(!$input){
      return redirect()->action("Hr_QuestionListController@edit");
    }
    return view("hr/interview/question/edit/form_confirm",['input' => $input]);
  }

  function editSend(Request $request){
    //セッションから値を取り出す
    $input = $request->session()->get("form_input");

    //戻るボタンが押された時
    if($request->has("back")){
      return redirect()->action("Hr_QuestionListController@edit")
        ->withInput($input);
    }

    //セッションに値が無い時はフォームに戻る
    if(!$input){
      return redirect()->action("Hr_QuestionListController@edit");
    }

    //=====処理内容====================================
    $interview = Interview::find($input['interview_id']);

    for ($index = 1; $index <= 3; $index++) {
      $questionData = Question::where('name', $input['question-'.$index]);
      $questionId = 'question_'. $index. '_id';

      $interview->$questionId = $questionData->first()->id;
    }
    $interview->save();
    //================================================

    //セッションを空にする
    $request->session()->forget("form_input");

    return redirect()->action("Hr_QuestionListController@editComplete");
  }

  function editComplete(){
    return view("hr/interview/question/edit/form_complete");
  }
  //====end : 変更===================================================================

}
