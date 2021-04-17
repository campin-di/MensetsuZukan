<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Hr_profile;
use App\Models\Interview;
use App\Models\Question;

class Hr_ScoringController extends Controller
{

    //== 質問リスト作成 関係　=======================================================
    private $formItems = ["name", "title", "body"];

    private $validator = [
      /*
      "name" => "required|string|max:100",
      "title" => "required|string|max:100",
      "body" => "required|string|max:100"
      */
    ];

    public function form($id)
    {
      $interview = Interview::with('question1:id,name')->with('question2:id,name')
                 ->with('question3:id,name')->with('question4:id,name')
                 ->with('question5:id,name')->with('question6:id,name')
                 ->select('id', 'question_1_id', 'question_2_id', 'question_3_id', 'question_4_id', 'question_5_id', 'question_6_id')->find($id);

      $questionArray = ['question1', 'question2', 'question3', 'question4', 'question5', 'question6'];

      return view('hr/interview/scoring/form',[
        'interview' => $interview,
        'questionArray' => $questionArray,
      ]);
    }

    public function post(Request $request)
    {

      $input = $request->all();

      //=====部分処理====================================
  /*
      $validator = Validator::make($input, $this->validator);
      if($validator->fails()){
        return redirect()->action("Hr_ScoringController@show")
          ->withInput()
          ->withErrors($validator);
      }
  */
      //================================================

      //セッションに書き込む
      $request->session()->put("form_input", $input);

      return redirect()->action("Hr_ScoringController@confirm");
    }

    function confirm(Request $request){
      //セッションから値を取り出す
      $input = $request->session()->get("form_input");

      //セッションに値が無い時はフォームに戻る
      if(!$input){
        return redirect()->action("Hr_ScoringController@form");
      }
      return view("hr/interview/scoring/form_confirm",['input' => $input]);
    }

    function send(Request $request){
      //セッションから値を取り出す
      $input = $request->session()->get("form_input");

      //戻るボタンが押された時
      if($request->has("back")){
        return redirect()->action("Hr_ScoringController@form")
          ->withInput($input);
      }

      //セッションに値が無い時はフォームに戻る
      if(!$input){
        return redirect()->action("Hr_ScoringController@form");
      }

      //=====処理内容====================================
      $interview = Interview::find($input['interview_id']);

      for ($index = 1; $index <= 6; $index++) {
        $questionData = Question::where('name', $input['question-'.$index]);
        $questionData->increment('times');

        $scoreCollumn = 'question_'. $index. '_score';
        $reviewCollumn = 'question_'. $index. '_review';
        $inputScoreName = 'question-'. $index;
        $inputReviewName = 'review-'. $index;

        $interview->$scoreCollumn = $input[$inputScoreName];
        $interview->$reviewCollumn = $input[$inputReviewName];
        $interview->available = 2;
      }
      $interview->save();
      //================================================

      //セッションを空にする
      $request->session()->forget("form_input");

      return redirect()->action("Hr_ScoringController@complete");
    }

    function complete(){
      return view("hr/interview/scoring/form_complete");
    }
}