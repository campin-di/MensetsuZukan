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
      'name' => $userData->name,
      'imagePath' => $userData->image_path,
      'company' => $userData->company,
      'introduction' => $userData->introduction,
    ];

    $pastVideos = Video::where('hr_id', $userData->id)->get();
    $pastVideosCollection = VideoDisplayClass::VideoDisplay($pastVideos);

    $interviewReservations = Interview::where('hr_id', $userData->id)->with('hr_user')->select('id', 'hr_id', 'date', 'url')->get();

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
