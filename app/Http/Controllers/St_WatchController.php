<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Common\DiffDateClass;
use App\Common\VideoDisplayClass;

use Google_Client;
use Google_Service_YouTube;

use App\Models\User;
use App\Models\HrUser;
use App\Models\Video;

class St_WatchController extends Controller
{
  public function index($id)
  {
    // Googleへの接続情報のインスタンスを作成と設定
    $client = new Google_Client();
    $client->setDeveloperKey(env('GOOGLE_API_KEY'));

    // 接続情報のインスタンスを用いてYoutubeのデータへアクセス可能なインスタンスを生成
    $youtube = new Google_Service_YouTube($client);

    $video = Video::where('id', $id)->get();

    $videosCollection = VideoDisplayClass::VideoDisplay($video);

    //$otherVideosCollection == 他の質問に対する動画
    $otherVideos =  Video::where('common_url', $video[0]->common_url)->where('question_id', '!=', $video[0]->question_id)->take(10)->get();
    $otherVideosCollection = collect([]);

    foreach ($otherVideos as $otherVideo) {
      $thumbnailsUrl = $youtube->videos->listVideos('statistics,snippet', array(
        'id' => $otherVideo->common_url,
      ))[0]['snippet']['thumbnails']['high']['url'];

      $diffDate = DiffDateClass::diffDate($otherVideo->created_at);

      $otherVideosCollection = $otherVideosCollection->concat([
        [
          'id' => $otherVideo->id,
          'thumbnailsUrl' => $thumbnailsUrl,
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
