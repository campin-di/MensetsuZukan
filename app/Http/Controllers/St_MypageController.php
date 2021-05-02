<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\User;
use App\Models\Video;
use App\Models\Interview;
use App\Models\St_profile;

use App\Common\VideoDisplayClass;

class St_MypageController extends Controller
{
  public function index()
  {
    $userId = Auth::user()->id;
    $userData = User::find($userId);

    $userDataArray = [
      'name' => $userData->name,
      'username' => $userData->username,
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
    $userId = Auth::user()->id;
    $stProfileDetails = St_profile::where('st_id', $userId)->get();

    return view('mypage/detail', [
      'stProfileDetails' => $stProfileDetails,
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
    $stProfileDetails = User::find($stId);
/*
    $detailsArray = [
      '' => ,
      '' => ,
      '' => ,
    ]
*/
    return view('mypage/their_detail', [
      'stProfileDetails' => $stProfileDetails,
    ]);
  }

}
