<?php

namespace App\Http\Controllers\St;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

use App\Models\User;
use App\Models\HrUser;
use App\Models\InterviewRequest;

use Illuminate\Support\Facades\Mail;

use App\Common\ReturnUserInformationArrayClass;

class RequestController extends Controller
{
    public function index($hr_id)
    {  
      $hrUser = HrUser::where('id', $hr_id)->select('id', 'nickname', 'company', 'image_path', 'industry')->first();
      
      return view('st/interview/request/form', compact('hrUser'));
    }

    public function post(Request $request)
    {
        $input = $request->all();

        //セッションに書き込む
        $request->session()->put("form_input", $input);

        //セッションから値を取り出す
        $input = $request->session()->get("form_input");

        //セッションに値が無い時はフォームに戻る
        if(!$input){
            return redirect()->action("St_InterviewController@search");
        }

        return view('st/interview/request/form_confirm', compact('input'));
    }

    function send(Request $request){
        //セッションから値を取り出す
        $input = $request->session()->get("form_input");

        //戻るボタンが押された時
        /*
        if($request->has("back")){
          return redirect()->action("St_InterviewController@search")->withInput($input);
        }
        */
    
        //セッションに値が無い時はフォームに戻る
        if(!$input){
          return redirect()->action("St_InterviewController@search");
        }
        $hrId = $input['hr_id'];
        $hr = HrUser::find($hrId);
        $st = Auth::user();

        $flag = FALSE;
        if(!InterviewRequest::where('st_id', $st->id)->where('hr_id', $hrId)->exists()){
            $interviewRequest = new InterviewRequest;
            $interviewRequest->st_id = $st->id;
            $interviewRequest->hr_id = $hrId;
            $interviewRequest->status = 0;
            $interviewRequest->schedule_candidate = str_replace(" ", "", $input['date']);
            $interviewRequest->save();
    
            Mail::send('st/interview/request/mail/reservation', ['hr' => $hr, 'st' => $st],
                function ($message) use ($hr, $st){
                $message->subject($st->nickname. 'さんから面接リクエストがありました！');
                $message->from('mensetsuzukan@pampam.co.jp', '面接図鑑');
                $message->to($hr->email);
                }
            );
        } else{
            $flag = TRUE;
        }

        //セッションを空にする
        $request->session()->forget("form_input");

        $lineFlag = is_null($st->line_id);

        return view('st/interview/request/form_complete', compact('flag', 'lineFlag'));

    }





}
