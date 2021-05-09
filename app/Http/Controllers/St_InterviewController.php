<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HrUser;
use App\Models\Interview;
use App\Models\Schedule;
use App\Common\CutStringClass;
use App\Common\ReturnTimeArrayClass;


class St_InterviewController extends Controller
{
  public function detail($id)
  {
    $interviewInfo = Interview::with('hr_user')->find($id);

    return view('st/interview/detail', [
      'interviewInfo' => $interviewInfo,
    ]);
  }

  public function search()
  {
    $hrs = HrUser::get();

    $hrCollection = collect([]);
    foreach ($hrs as $hr) {
      $hrCollection = $hrCollection->concat([
        [
          'id' => $hr->id,
          'name' => $hr->name,
          'introduction' => CutStringClass::CutString($hr->introduction, 40),
        ],
      ]);
    }

    return view('st/interview/search', [
      'hrCollection' => $hrCollection,
    ]);
  }

  public function cancelConfirm($id)
  {
    return view('st/interview/cancel/confirm', compact('id'));
  }

  public function cancel($id)
  {
    $interviewInfo = Interview::with('hr_user')->find($id);
    $hrSchedule = Schedule::where('hr_id', $interviewInfo->hr_id)->where('date', $interviewInfo->date)->first();

    $timeArray = ReturnTimeArrayClass::returnTimeArray();
    foreach ($timeArray as $key => $value) {
      if($value == $interviewInfo->time){
        $hrSchedule->$key = 1;
        $hrSchedule->save();
      }
    }

    $interviewInfo->delete();

    return view('st/interview/cancel/complete');
  }
}
