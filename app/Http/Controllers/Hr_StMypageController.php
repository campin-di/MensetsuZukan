<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Common\VideoDisplayClass;

use App\Models\User;
use App\Models\St_profile;
use App\Models\Video;
use App\Models\Interview;

class Hr_StMypageController extends Controller
{
  public function index($stId)
  {
    $user = User::find($stId);

    $pastVideos = Video::where('st_id', $stId)->get();
    $pastVideosCollection = VideoDisplayClass::VideoDisplay($pastVideos);

    $interviewReservations = Interview::where('st_id', $stId)->with('hr_user')->select('hr_id', 'date', 'url')->get();

    return view('hr/stMypage/mypage', [
      'stId' => $stId,
      'stName' => $user->name,
      'nickname' => $user->nickname,
      'pastVideosCollection' => $pastVideosCollection,
    ]);
  }

  public function detail($stId)
  {
    $userData = User::find($stId);

    $profileDetailArray = [
      'companyType' => $userData->company_type,
      'industry' => $userData->industry,
      'jobtype' => $userData->jobtype,
      'workplace' => $userData->workplace,
      'startTime' => $userData->start_time,
      'strengths' => $userData->strengths,
      'gakuchika' => $userData->gakuchika,
      'personality' => $userData->personality,
      'toeic' => $userData->toeic,
      'english' => $userData->english,
      'otherLanguage' => $userData->other_language,
      'qualification' => $userData->qualification,
    ];

    return view('hr/stMypage/detail', [
      'stId' => $stId,
      'profileDetailArray' => $profileDetailArray,
    ]);
  }
}
