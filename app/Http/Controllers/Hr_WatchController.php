<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Common\DiffDateClass;

use App\Models\User;
use App\Models\HrUser;
use App\Models\Video;

use App\Common\VideoDisplayClass;

use Google_Client;
use Google_Service_YouTube;

class Hr_WatchController extends Controller
{
  public function index($id)
  {
    $video = Video::where('id', $id)->get();

    $videosCollection = VideoDisplayClass::VideoDisplay($video);

    //$otherVideosCollection == 他の質問に対する動画
    $otherVideos =  Video::where('common_url', $video[0]->common_url)->where('question_id', '!=', $video[0]->question_id)->take(10)->get();
    $otherVideosCollection = VideoDisplayClass::VideoDisplay($otherVideos);

    return view('hr\watch',[
      'videosCollection' => $videosCollection,
      'otherVideosCollection' => $otherVideosCollection,
    ]);
  }
}