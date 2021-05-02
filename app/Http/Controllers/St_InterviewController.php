<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Common\CutStringClass;

use App\Models\HrUser;
use App\Models\Interview;

class St_InterviewController extends Controller
{
  public function detail($id)
  {
    $interviewInfo = Interview::with('hr_user')->find($id);

    return view('interview/detail', [
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

    return view('interview/search', [
      'hrCollection' => $hrCollection,
    ]);
  }
}
