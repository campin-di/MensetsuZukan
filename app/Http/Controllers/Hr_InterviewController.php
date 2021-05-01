<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Common\CutStringClass;
use App\Common\MeetingClass;

use App\Models\Hr_profile;
use App\Models\Interview;
use App\Models\Question;

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

    //もし面接時間を30分すぎていたら、interview->availableを2に設定する。
    if($now->min($startedInterview) == $startedInterview) {
      \DB::table('interviews')->where('id', $id)->update([
        'available' => 2,
        'url' => 'done',
      ]);
    }

    $flag = $interviewInfo->available;

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
}
