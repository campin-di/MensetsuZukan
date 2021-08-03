<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Common\ScoringTermsClass;
use App\Models\User;
use App\Models\HrUser;
use App\Models\Interview;
use App\Models\Question;
use App\Models\Batting;

use Carbon\Carbon;
use DateTime;

class Hr_ScoringController extends Controller
{
    //== 質問リスト作成 関係　=======================================================
    public function form($id)
    {
      $questions = Question::get();
      $scoringTerms = ScoringTermsClass::scoringTerms();
      $zoomUrl = Interview::find($id)->zoomUrl;

      return view('hr/interview/scoring/form', compact('id', 'questions', 'scoringTerms', 'zoomUrl'));
    }

    public function post(Request $request)
    {
      $input = $request->all();

      //セッションに書き込む
      $request->session()->put("form_input", $input);

      return redirect()->action("Hr_ScoringController@confirm");
    }

    function confirm(Request $request){
      //セッションから値を取り出す
      $input = $request->session()->get("form_input");

      //セッションに値が無い時はフォームに戻る
      if(!$input){
        return redirect()->action("Hr_HrMypageController@index");
      }

      $scoringTerms = ScoringTermsClass::scoringTerms();
      $scoringSignals = ScoringTermsClass::scoringSignals();
      return view("hr/interview/scoring/form_confirm",compact('input', 'scoringTerms', 'scoringSignals'));
    }

    function send(Request $request){
      //セッションから値を取り出す
      $input = $request->session()->get("form_input");

      //戻るボタンが押された時
      if($request->has("back")){
        return redirect()->action("Hr_HrMypageController@index")
          ->withInput($input);
      }

      //セッションに値が無い時はフォームに戻る
      if(!$input){
        return redirect()->action("Hr_HrMypageController@index");
      }

      //=====処理内容====================================
      $interview = Interview::find($input['interview_id']);

      $questions = Question::get();

      for ($index = 1; $index <= 3; $index++) {
        $questionData = Question::where('name', $input['question-'.$index]);
        $questionData->increment('times');
        $questionId = $questions->where('name', $input['question-'. $index])->first()->id;
        $questionColumn = 'question_'. $index. '_id';
        $interview->$questionColumn = $questionId;
      }

      $interview->available = config('const.INTERVIEW.DONE');

      for ($index = 1; $index <= 10; $index++) {
        $scoreColumn = 'score_'. $index;
        $interview->$scoreColumn = $input['term'.$index];
      }

      $interview->review_good = $input['review-good'];
      $interview->review_more = $input['review-more'];

      $interview->save();

      $stUser = User::find($interview->st_id);
      $stUser->status = config('const.USER_STATUS.AVAILABLE');
      $stUser->save();

      $hrUser = HrUser::find($interview->hr_id);
      $hrUser->status = config('const.USER_STATUS.AVAILABLE');
      $hrUser->save();
      //================================================

      //セッションを空にする
      $request->session()->forget("form_input");

      return redirect()->action("Hr_ScoringController@complete");
    }

    function complete(){

    //昨日以前のbattingテーブルのデータを削除する
    $yesterday = new DateTime('-1 day');
    $targets = Batting::where('date', '<', $yesterday)->get();

    foreach($targets as $target){
      $target->delete();
    }

      return view("hr/interview/scoring/form_complete");
    }
}
