<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Common\DiffDateClass;
use App\Common\VideoDisplayClass;
use App\Common\RedirectClass;

use Google_Client;
use Google_Service_YouTube;

use App\Models\User;
use App\Models\HrUser;
use App\Models\Video;

class St_WatchController extends Controller
{
  public function index($id)
  {
    //=====もし視聴不可状態のときはリダイレクト===================================
    if($redirect = RedirectClass::stRedirect()){
      if($redirect){
        return redirect()->action($redirect);
      }
    }
    //==========================================================================
/*
    // Googleへの接続情報のインスタンスを作成と設定
    $client = new Google_Client();
    $client->setDeveloperKey(env('GOOGLE_API_KEY'));

    // 接続情報のインスタンスを用いてYoutubeのデータへアクセス可能なインスタンスを生成
    $youtube = new Google_Service_YouTube($client);
*/
  if(!session()->has('access')){
    $targetVideo = Video::where('id', $id)->first();
    $targetVideo->views++;
    $targetVideo->save();

    session(['access' => true]);
  } 


    $video = Video::where('id', $id)->get();

    $videosCollection = VideoDisplayClass::VideoDisplay($video);
    $mainVideo = current($videosCollection)[0];

    //$otherVideosCollection == 他の質問に対する動画
    $otherVideos =  Video::where('vimeo_id', $video[0]->vimeo_id)->where('question_id', '!=', $video[0]->question_id)->take(10)->get();
    $otherVideosCollection = VideoDisplayClass::VideoDisplay($otherVideos);

    return view('st.watch',[
      'mainVideo' => $mainVideo,
      'otherVideosCollection' => $otherVideosCollection,
    ]);
  }

}
