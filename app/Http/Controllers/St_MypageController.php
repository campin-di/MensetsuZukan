<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\User;
use App\Models\Video;
use App\Models\Interview;

use App\Common\VideoDisplayClass;

class St_MypageController extends Controller
{
  public function index()
  {
    $userId = Auth::user()->id;
    $userData = User::find($userId);

    $userDataArray = [
      'name' => $userData->name,
      'nickname' => $userData->nickname,
      'plan' => $userData->plan,
    ];

    $pastVideos = Video::where('st_id', $userId)->get();
    $pastVideosCollection = VideoDisplayClass::VideoDisplay($pastVideos);

    $interviewReservations = Interview::where('st_id', $userId)->with('hr_user')->select('id', 'hr_id', 'date', 'url')->get();

    $interviewReservationsCollection = collect();
    foreach ($interviewReservations as $interviewReservation) {
      $interviewReservationsCollection = $interviewReservationsCollection->concat([
        [
          'id' => $interviewReservation->id,
          'name' => $interviewReservation->hr_user->name,
          'date' => $interviewReservation->date,
        ],
      ]);
    }

    return view('mypage/mypage', [
      'userDataArray' => $userDataArray,
      'pastVideosCollection' => $pastVideosCollection,
      'interviewReservationsCollection' => $interviewReservationsCollection,
    ]);
  }

  public function myDetail()
  {
    $userData = Auth::user();

    $profileDetailArray = [
      'companyType' => $userData->company_type,
      'industry' => $userData->industry_id,
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

    return view('mypage/detail', [
      'profileDetailArray' => $profileDetailArray,
    ]);
  }

  public function TheirPage($stId)
  {
    $loginId = Auth::user()->id;

    //自分のユーザネームをクリックした場合
    if($loginId == $stId){
      return redirect()->action("St_MypageController@index", $loginId);
    }

    $pastVideos = Video::where('st_id', $stId)->get();
    $pastVideosCollection = VideoDisplayClass::VideoDisplay($pastVideos);

    $interviewReservations = Interview::where('st_id', $stId)->with('hr_user')->select('hr_id', 'date', 'url')->get();

    return view('mypage/their_page', [
      'stId' => $stId,
      'nickname' => User::find($stId)->nickname,
      'pastVideosCollection' => $pastVideosCollection,
    ]);
  }

  public function theirDetail($stId)
  {
    $userData = User::find($stId);

    $profileDetailArray = [
      'companyType' => $userData->company_type,
      'industry' => $userData->industry_id,
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

    return view('mypage/their_detail', [
      'profileDetailArray' => $profileDetailArray,
    ]);
  }

}
