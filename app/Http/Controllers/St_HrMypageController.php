<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Common\VideoDisplayClass;

use App\Models\HrUser;
use App\Models\Hr_profile;
use App\Models\Video;
use App\Models\Interview;

class St_HrMypageController extends Controller
{
  public function index($id)
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

    return view('hrMypage/mypage', [
      'userDataArray' => $userDataArray,
      'pastVideosCollection' => $pastVideosCollection,
    ]);
  }
  public function detail($id)
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

    return view('hrMypage/detail', [
      'profileCollection' => $profileCollection,
    ]);
  }
}
