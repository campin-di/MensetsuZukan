<?php

namespace App\Http\Controllers;
use Auth;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Common\CutStringClass;
use App\Common\MeetingClass;

use App\Models\User;
use App\Models\HrUser;
use App\Models\Interview;
use App\Models\Question;

use Illuminate\Support\Facades\Mail;

class Hr_InterviewController extends Controller
{
  //from mypage to detail page
  public function detail($id)
  {
    $interviewInfo = Interview::with('st_user')->find($id);

    $startTime = strstr($interviewInfo->time, ' -', true) . ':00';
    $startInterview = new Carbon($interviewInfo->date. ' '. $startTime, 'Asia/Tokyo');
    $startedInterview = $startInterview->addMinutes(30);

    $now = new Carbon('now', 'Asia/Tokyo');

    $flag = config('const.INTERVIEW.AVAILABLE');
    //もし面接時間を30分すぎていたら、interview->availableを2に設定する。
    if($now->min($startedInterview) == $startedInterview) {
      \DB::table('interviews')->where('id', $id)->update([
        'available' => config('const.INTERVIEW.UNSCORE'),
        'zoomUrl' => 'done',
      ]);
      $flag = config('const.INTERVIEW.UNSCORE');
    }

    return view('hr/interview/detail', [
      'interviewInfo' => $interviewInfo,
      'flag' => $flag,
    ]);
  }

  //from detail page to pre interview page
  public function pre($id)
  {
    $interviewInfo = Interview::find($id);

    return view('hr/interview/pre', [
      'interviewInfo' => $interviewInfo,
    ]);
  }

  public function cancelConfirm($id)
  {
    return view('hr/interview/cancel/confirm', compact('id'));
  }

  public function cancel($id)
  {
    $interviewInfo = Interview::find($id);
    
    $hr = HrUser::find(Auth::guard('hr')->id());
    $st = User::find($interviewInfo->st_id);

    $mailDateArray = [
      'date' => $interviewInfo->date,
      'time' => $interviewInfo->time,
    ];

    $interviewInfo->delete();

    Mail::send('hr/interview/cancel/mail/cancel', ['mailDateArray' => $mailDateArray, 'hr' => $hr, 'st' => $st],
      function ($message) use ($hr, $st){
        $message->subject($st->nickname. 'さんとの面接がキャンセルされました。');
        $message->from('mensetsu-zukan@digitalidentity.co.jp', 'デジマ面接図鑑');
        $message->to($hr->email);
      }
    );

    return view('hr/interview/cancel/complete');
  }
}
