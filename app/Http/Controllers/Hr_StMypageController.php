<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Common\VideoDisplayClass;

use App\Models\User;
use App\Models\St_profile;
use App\Models\Video;
use App\Models\Interview;

class Hr_StMypageController extends Controller
{
  public function index($username)
  {
    $userId = User::where('username', $username)->first()->id;

    $pastVideos = Video::where('st_id', $userId)->get();
    $pastVideosCollection = VideoDisplayClass::VideoDisplay($pastVideos);

    $interviewReservations = Interview::where('st_id', $userId)->with('hr_user')->select('hr_id', 'date', 'url')->get();

    return view('hr/stMypage/mypage', [
      'username' => $username,
      'pastVideosCollection' => $pastVideosCollection,
    ]);
  }

  public function detail($username)
  {
    $userId = User::where('username', $username)->first()->id;
    $profile = St_profile::where('st_id', $userId)->first();

    $profileCollection = collect();

    if(is_null($profile)){
      $profileCollection = $profileCollection->concat([
        [
          'pr' => "設定されていません。",
          'gakuchika' => "設定されていません。",
          'frustration' => "設定されていません。",
        ],
      ]);
    } else {
      $profileCollection = $profileCollection->concat([
        [
          'pr' => $profile->pr,
          'gakuchika' => $profile->gakuchika,
          'frustration' => $profile->gakuchika,
        ],
      ]);
    }


    return view('hr/stMypage/detail', [
      'profileCollection' => $profileCollection,
    ]);
  }
}
