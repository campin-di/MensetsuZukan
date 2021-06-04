<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\User;
use App\Models\HrUser;
use App\Models\Video;
use App\Models\Interview;

use App\Common\VideoDisplayClass;

class Hr_HrMypageController extends Controller
{
  public function index()
  {
    $userId = Auth::guard('hr')->id();
    $userData = HrUser::find($userId);

    $pastVideos = Video::where('hr_id', $userId)->get();
    $pastVideosCollection = VideoDisplayClass::VideoDisplay($pastVideos);

    $interviewReservations = Interview::where('available', '!=', 9)->where('hr_id', $userId)->with('st_user')->select('id', 'st_id', 'date', 'url')->get();

    $interviewReservationsCollection = collect();
    foreach ($interviewReservations as $interviewReservation) {
      $interviewReservationsCollection = $interviewReservationsCollection->concat([
        [
          'id' => $interviewReservation->id,
          'name' => $interviewReservation->st_user->name,
          'date' => $interviewReservation->date,
        ],
      ]);
    }

    return view('hr/mypage/mypage', [
      'userData' => $userData,
      'pastVideosCollection' => $pastVideosCollection,
      'interviewReservationsCollection' => $interviewReservationsCollection,
    ]);
  }

  public function myDetail()
  {
    $hrId = Auth::guard('hr')->id();
    $userData = HrUser::find($hrId);

    return view('hr/mypage/detail', [
      'hrId' => $hrId,
      'userData' => $userData,
    ]);
  }

  public function hrpage($id)
  {
    $userData = HrUser::find($id);

    $pastVideos = Video::where('hr_id', $userData->id)->get();
    $pastVideosCollection = VideoDisplayClass::VideoDisplay($pastVideos);

    $interviewReservations = Interview::where('hr_id', $userData->id)->with('hr_user')->select('id', 'hr_id', 'date', 'url')->get();

    return view('hr/hrpage/hrpage', [
      'userData' => $userData,
      'pastVideosCollection' => $pastVideosCollection,
    ]);
  }

  public function hrDetail($id)
  {
    $profile = HrUser::find($id);

    $profileCollection = collect();
    $profileCollection = $profileCollection->concat([
      [
        'introduction' => $profile->introduction,
        'pr' => $profile->pr,
      ],
    ]);

    return view('hr/hrpage/detail', [
      'profileCollection' => $profileCollection,
    ]);
  }
}
