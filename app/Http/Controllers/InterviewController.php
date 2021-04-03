<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
