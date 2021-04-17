<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\User;
use App\Models\HrUser;
use App\Models\Hr_profile;
use App\Models\Video;
use App\Models\Interview;

use App\Common\VideoDisplayClass;

class Hr_HrMypageController extends Controller
{
  public function index()
  {
    $userId = Auth::guard('hr')->id();
    $userData = HrUser::find($userId);

    $userDataArray = [
      'name' => $userData->name,
      'username' => $userData->username,
    ];

    $pastVideos = Video::where('hr_id', $userId)->get();
    $pastVideosCollection = VideoDisplayClass::VideoDisplay($pastVideos);

    $interviewReservations = Interview::where('hr_id', $userId)->with('st_user')->select('id', 'st_id', 'date', 'url')->get();

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

    return view('hr/hrMypage/mypage', [
      'userDataArray' => $userDataArray,
      'pastVideosCollection' => $pastVideosCollection,
      'interviewReservationsCollection' => $interviewReservationsCollection,
    ]);
  }

  public function myDetail()
  {
    $userId = Auth::guard('hr')->id();
    $hrProfileDetail = Hr_profile::find($userId)->first();

    return view('hr/hrMypage/detail', [
      'hrProfileDetail' => $hrProfileDetail,
    ]);
  }

  public function theirPage($id)
  {
    $userData = HrUser::find($id);

    $userDataArray = [
      'id' => $id,
      'name' => $userData->name,
      'username' => $userData->username,
    ];

    $pastVideos = Video::where('hr_id', $userData->id)->get();
    $pastVideosCollection = VideoDisplayClass::VideoDisplay($pastVideos);

    $interviewReservations = Interview::where('hr_id', $userData->id)->with('hr_user')->select('id', 'hr_id', 'date', 'url')->get();

    return view('hr/hrMypage/theirPage', [
      'userDataArray' => $userDataArray,
      'pastVideosCollection' => $pastVideosCollection,
    ]);
  }

  public function theirDetail($id)
  {
    $profile = Hr_profile::where('hr_id', $id)->first();

    $profileCollection = collect();

    if(is_null($profile)){
      $profileCollection = $profileCollection->concat([
        [
          'introduction' => "設定されていません。",
          'pr' => "設定されていません。",
        ],
      ]);
    } else {
      $profileCollection = $profileCollection->concat([
        [
          'introduction' => $profile->introduction,
          'pr' => $profile->pr,
        ],
      ]);
    }

    return view('hr/hrMypage/theirDetail', [
      'profileCollection' => $profileCollection,
    ]);
  }
}