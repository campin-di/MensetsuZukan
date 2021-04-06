<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Common\VideoDisplayClass;

class St_HrMypageController extends Controller
{
  public function index()
  {
    $userId = Auth::user()->id;
    $userData = User::find($userId);

    $userDataArray = [
      'name' => $userData->name,
      'username' => $userData->username,
    ];

    $pastVideos = Video::where('hr_id', $userId)->get();
    $pastVideosCollection = VideoDisplayClass::VideoDisplay($pastVideos);

    $interviewReservations = Interview::where('hr_id', $userId)->with('hr_user')->select('id', 'hr_id', 'date', 'url')->get();

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
}
