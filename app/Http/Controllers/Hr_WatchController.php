<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Common\DiffDateClass;

use App\Models\User;
use App\Models\HrUser;
use App\Models\Video;

use App\Common\VideoDisplayClass;
use App\Common\RedirectClass;

use Google_Client;
use Google_Service_YouTube;

class Hr_WatchController extends Controller
{
  public function index($id)
  {

    //=====もし視聴不可状態のときはリダイレクト===================================
    if($redirect = RedirectClass::hrOfferRedirect()){
      if($redirect){
        return redirect()->action($redirect);
      }
    }
    //==========================================================================

    $video = Video::where('id', $id)->get();

    $videosCollection = VideoDisplayClass::VideoDisplay($video);
    $mainVideo = current($videosCollection)[0];

    //$otherVideosCollection == 他の質問に対する動画
    $otherVideos =  Video::where('common_url', $video[0]->common_url)->where('question_id', '!=', $video[0]->question_id)->take(10)->get();
    $otherVideosCollection = VideoDisplayClass::VideoDisplay($otherVideos);

    return view('hr\watch',[
      'mainVideo' => $mainVideo,
      'otherVideosCollection' => $otherVideosCollection,
    ]);
  }
}
