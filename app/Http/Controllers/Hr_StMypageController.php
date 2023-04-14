<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Common\VideoDisplayClass;

use App\Models\User;
use App\Models\Video;
use App\Models\Interview;

class Hr_StMypageController extends Controller
{
  public function index($stId)
  {
    $userData = User::find($stId);

    $pastVideos = Video::where('st_id', $stId)->where('type', config('const.STHR.HR'))->get();
    $pastVideosCollection = VideoDisplayClass::VideoDisplay($pastVideos);

    return view('hr/stpage/stpage', [
      'userData' => $userData,
      'pastVideosCollection' => $pastVideosCollection,
    ]);
  }

  public function detail($stId)
  {
    $userData = User::find($stId);

    $major = '文系';
    if($userData->major == 2){
      $major = '理系';
    }

    $profileDetailArray = [
      'university' => $userData->university,
      'faculty' => $userData->faculty,
      'department' => $userData->department,
      'major' => $major,
      'graduate_year' => $userData->graduate_year,
      'companyType' => $userData->company_type,
      'industry' => $userData->industry,
      'jobtype' => $userData->jobtype,
      'workplace' => $userData->workplace,
      'startTime' => $userData->start_time,
      'strengths' => $userData->strengths,
      'gakuchika' => $userData->gakuchika,
      'personality' => $userData->personality,
      'toeic' => $userData->toeic,
      'englishLevel' => $userData->english_level,
      'otherLanguage' => $userData->other_language,
      'qualification' => $userData->qualification,
    ];

    return view('hr/stpage/detail', [
      'stId' => $stId,
      'profileDetailArray' => $profileDetailArray,
    ]);
  }
}
