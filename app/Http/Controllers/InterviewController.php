<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Common\CutStringClass;

use App\Models\Hr_profile;
use App\Models\Interview;

class InterviewController extends Controller
{
  public function preStart($id)
  {
    $interviewInfo = Interview::with('hr_user')->find($id);

    return view('interview/pre_start', [
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

    return view('interview/search', [
      'hrCollection' => $hrCollection,
    ]);
  }
}
