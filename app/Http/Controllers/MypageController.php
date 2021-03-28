<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\User;
use App\Models\Video;

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

    //TODO::今は重くなりすぎるのでtake()を使用しているが、後々JSを用いて変更する。
    $pastVideos = Video::where('st_id', $userId)->take(10)->get();

    $pastVideosCollection = VideoDisplayClass::VideoDisplay($pastVideos);

    return view('mypage/mypage', [
      'userDataArray' => $userDataArray,
      'pastVideosCollection' => $pastVideosCollection,
    ]);
  }
}
