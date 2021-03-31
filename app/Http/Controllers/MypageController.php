<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\User;
use App\Models\Video;
use App\Models\Interview;
use App\Models\St_profile;

use App\Common\VideoDisplayClass;

class MypageController extends Controller
{
  public function index()
  {
    $userId = Auth::user()->id;
    $userData = User::find($userId);

    $userDataArray = [
      'id' => $userData->id,
      'name' => $userData->name,
      'username' => $userData->username,
    ];

    $pastVideos = Video::where('st_id', $userId)->get();
    $pastVideosCollection = VideoDisplayClass::VideoDisplay($pastVideos);

    $interviewReservations = Interview::where('st_id', $userId)->with('hr_user')->select('hr_id', 'date', 'url')->get();

    $interviewReservationsCollection = collect();
    foreach ($interviewReservations as $interviewReservation) {
      $interviewReservationsCollection = $interviewReservationsCollection->concat([
        [
          'name' => $interviewReservation->hr_user->name,
          'date' => $interviewReservation->date,
          'url' => $interviewReservation->url,
        ],
      ]);
    }

    return view('mypage/mypage', [
      'userDataArray' => $userDataArray,
      'pastVideosCollection' => $pastVideosCollection,
      'interviewReservationsCollection' => $interviewReservationsCollection,
    ]);
  }

  public function detail()
  {
    $userId = Auth::user()->id;
    $stProfileDetails = St_profile::where('st_id', $userId)->get();

    return view('mypage/detail', [
      'stProfileDetails' => $stProfileDetails,
    ]);
  }
}
