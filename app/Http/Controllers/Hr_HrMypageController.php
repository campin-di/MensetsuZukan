<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\User;
use App\Models\HrUser;
use App\Models\Video;
use App\Models\Interview;
use App\Models\InterviewRequest;

use App\Common\VideoDisplayClass;

class Hr_HrMypageController extends Controller
{
  public function index()
  {
    $userId = Auth::guard('hr')->id();
    $userData = HrUser::find($userId);

    $pastVideos = Video::where('hr_id', $userId)->where('type', 1)->get();
    $pastVideosCollection = VideoDisplayClass::VideoDisplay($pastVideos);

    $interviewReservations = Interview::orderBy('date', 'asc')->where('available', '!=', -1)->where('hr_id', $userId)->with('st_user')->select('id', 'st_id', 'date', 'time', 'zoomUrl')->get();

    $interviewReservationsCollection = collect();
    foreach ($interviewReservations as $interviewReservation) {
      $dateArray = explode('-', $interviewReservation->date);
      $month = $dateArray[1];
      if((str_split($dateArray[1])[0] == 0)){
        $month = str_split($dateArray[1])[1];
      }
      $time = explode('-', $interviewReservation->time)[0].'〜';

      $interviewReservationsCollection = $interviewReservationsCollection->concat([
        [
          'id' => $interviewReservation->id,
          'nickname' => $interviewReservation->st_user->nickname,
          'date' => $month.'月'.$dateArray[2].'日',
          'time' => $time,
        ],
      ]);
    }

    $isRequest = InterviewRequest::where('hr_id', $userId)->where('status', 0)->count();

    return view('hr/mypage/mypage', compact('userData', 'pastVideosCollection', 'interviewReservationsCollection', 'isRequest'));
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
    $loginId = Auth::guard('hr')->id();

    if($loginId == $id){
      return redirect()->action("Hr_HrMypageController@index");
    }

    $userData = HrUser::find($id);

    $pastVideos = Video::where('hr_id', $userData->id)->where('type', 1)->get();
    $pastVideosCollection = VideoDisplayClass::VideoDisplay($pastVideos);

    return view('hr/hrpage/hrpage', [
      'userData' => $userData,
      'pastVideosCollection' => $pastVideosCollection,
    ]);
  }

  public function hrDetail($id)
  {
    $userData = HrUser::find($id);

    return view('hr/hrpage/detail', [
      'userData' => $userData,
    ]);
  }
}
