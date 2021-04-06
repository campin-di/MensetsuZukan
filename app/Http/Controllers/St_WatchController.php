<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Common\DiffDateClass;
use App\Common\VideoDisplayClass;

use App\Models\User;
use App\Models\HrUser;
use App\Models\Video;

class St_WatchController extends Controller
{
  public function index($id)
  {
    $video = Video::where('id', $id)->get();

    $videosCollection = VideoDisplayClass::VideoDisplay($video);


    //$otherVideosCollection == 他の質問に対する動画
    $otherVideos =  Video::where('common_url', $video[0]->common_url)->where('question_id', '!=', $video[0]->question_id)->take(10)->get();
    $otherVideosCollection = collect([]);

    foreach ($otherVideos as $otherVideo) {
      $diffDate = DiffDateClass::diffDate($otherVideo->created_at);

      $otherVideosCollection = $otherVideosCollection->concat([
        [
          'id' => $otherVideo->id,
          'url' => $otherVideo->url,
          'title' => $otherVideo->title,
          'score' => $otherVideo->score,
          'views' => $otherVideo->views,
          'good'  => $otherVideo->good,
          'diffDate' => $diffDate,
          'question' => $otherVideo->question,
        ],
      ]);
    }

    return view('watch',[
      'videosCollection' => $videosCollection,
      'otherVideosCollection' => $otherVideosCollection,
    ]);
  }

}
