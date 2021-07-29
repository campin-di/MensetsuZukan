<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Common\VideoDisplayClass;

use App\Models\HrUser;
use App\Models\Video;
use App\Models\Interview;

class St_HrMypageController extends Controller
{
  public function index($id)
  {
    $userData = HrUser::find($id);

    $userDataArray = [
      'id' => $id,
      'nickname' => $userData->nickname,
      'imagePath' => $userData->image_path,
      'industry' => $userData->industry,
      'introduction' => $userData->introduction,
    ];

    $pastVideos = Video::where('hr_id', $userData->id)->where('type', config('const.STHR.ST'))->get();
    $pastVideosCollection = VideoDisplayClass::VideoDisplay($pastVideos);
    
    return view('st/hrpage/hrpage', [
      'userDataArray' => $userDataArray,
      'pastVideosCollection' => $pastVideosCollection,
    ]);
  }
  public function detail($id)
  {
    $userData = HrUser::find($id);

    return view('st/hrpage/detail', compact('userData'));
  }
}
