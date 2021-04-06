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

  public function TheirPage($username)
  {
    $loginId = Auth::user()->id;
    $userId = User::where('username', $username)->first()->id;

    //自分のユーザネームをクリックした場合
    if($loginId == $userId){
      return redirect()->action("St_MypageController@index", $loginId);
    }

    $pastVideos = Video::where('st_id', $userId)->get();
    $pastVideosCollection = VideoDisplayClass::VideoDisplay($pastVideos);

    $interviewReservations = Interview::where('st_id', $userId)->with('hr_user')->select('hr_id', 'date', 'url')->get();

    return view('mypage/their_page', [
      'username' => $username,
      'pastVideosCollection' => $pastVideosCollection,
    ]);
  }

  public function theirDetail($username)
  {
    $userId = User::where('username', $username)->first()->id;
    $stProfileDetails = St_profile::where('st_id', $userId)->get();

    return view('mypage/their_detail', [
      'stProfileDetails' => $stProfileDetails,
    ]);
  }

}
