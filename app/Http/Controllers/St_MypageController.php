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
      'introduction' => $userData->introduction,
      'imagePath' => $userData->image_path,
      'industry' => $userData->industry,
      'graduate_year' => $userData->graduate_year,
      'plan' => $userData->plan,
    ];

    $pastVideos = Video::where('st_id', $userId)->get();
    $pastVideosCollection = VideoDisplayClass::VideoDisplay($pastVideos);

    $interviewReservations = Interview::orderBy('date', 'asc')->where('available', '!=', -1)->where('st_id', $userId)->with('hr_user:id,nickname,image_path,industry')->select('id', 'hr_id', 'date', 'zoomUrl')->get();

    $interviewReservationsCollection = collect();
    foreach ($interviewReservations as $interviewReservation) {
      $interviewReservationsCollection = $interviewReservationsCollection->concat([
        [
          'id' => $interviewReservation->id,
          'nickname' => $interviewReservation->hr_user->nickname,
          'imagePath' => $interviewReservation->hr_user->image_path,
          'date' => $interviewReservation->date,
        ],
      ]);
    }

    return view('st/mypage/mypage', [
      'userDataArray' => $userDataArray,
      'interviewReservations' => $interviewReservations,
      'interviewReservationsCollection' => $interviewReservationsCollection,
      'pastVideosCollection' => $pastVideosCollection,
    ]);
  }

  public function myDetail()
  {
    $userData = Auth::user();

    $profileDetailArray = [
      'name' => $userData->name,
      'nickname' => $userData->nickname,
      'introduction' => $userData->introduction,
      'imagePath' => $userData->image_path,
      'industry' => $userData->industry,
      'graduate_year' => $userData->graduate_year,
      'plan' => $userData->plan,
      'companyType' => $userData->company_type,
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

    return view('st/mypage/detail', [
      'profileDetailArray' => $profileDetailArray,
    ]);
  }

  public function stpage($stId)
  {
    $loginId = Auth::user()->id;

    //自分のユーザネームをクリックした場合
    if($loginId == $stId){
      return redirect()->action("St_MypageController@index");
    }

    $userData = User::find($stId);

    $userDataArray = [
      'stId' => $userData->id,
      'nickname' => $userData->nickname,
      'introduction' => $userData->introduction,
      'imagePath' => $userData->image_path,
      'industry' => $userData->industry,
      'graduate_year' => $userData->graduate_year,
      'plan' => $userData->plan,
    ];

    $pastVideos = Video::where('st_id', $stId)->get();
    $pastVideosCollection = VideoDisplayClass::VideoDisplay($pastVideos);

    return view('st/stpage/stpage', [
      'userDataArray' => $userDataArray,
      'pastVideosCollection' => $pastVideosCollection,
    ]);
  }

  public function stDetail($stId)
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
      'englishLevel' => $userData->english_level,
      'otherLanguage' => $userData->other_language,
      'qualification' => $userData->qualification,
    ];

    return view('st/stpage/detail', compact('profileDetailArray'));
  }
}
