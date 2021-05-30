<?php

namespace app\Common;
use Carbon\Carbon;

use App\Models\User;
use App\Models\HrUser;
use App\Models\Video;
use App\Models\Question;

use App\Common\DiffDateClass;

use Google_Client;
use Google_Service_YouTube;

class VideoDisplayClass
{
    public static function VideoDisplay($videos)
    {
/*
      // Googleへの接続情報のインスタンスを作成と設定
      $client = new Google_Client();
      $client->setDeveloperKey(env('GOOGLE_API_KEY'));

      // 接続情報のインスタンスを用いてYoutubeのデータへアクセス可能なインスタンスを生成
      $youtube = new Google_Service_YouTube($client);

      $count = $videos->count();
*/
      $videosCollection = collect([]);
      foreach ($videos as $video) {
/*
        $thumbnailsUrl = $youtube->videos->listVideos('statistics,snippet', array(
          'id' => $video->common_url,
        ))[0]['snippet']['thumbnails']['high']['url'];
*/
        $diffDate = DiffDateClass::diffDate($video->created_at);

        $stUser = User::find($video->st_id);
        $stNickname = $stUser->nickname;
        $stName = $stUser->name;
        $hrUser = HrUser::find($video->hr_id);
        $hrName = $hrUser->name;

        $question = Question::find($video->question_id)->name;
        $otherQuestionsArray = Video::with('question')->where('vimeo_id', $video->vimeo_id)->where('question_id', '!=', $video->question_id)->select('question_id')->get();

        $videosCollection = $videosCollection->concat([
          [
            'id' => $video->id,
            //'thumbnailsUrl' => $thumbnailsUrl,
            'vimeo_src' => $video->vimeo_src,
            'thumbnail_path' => $video->thumbnail_path,
            'title' => $video->title,
            'score' => $video->score,
            'views' => $video->views,
            'good'  => $video->good,
            'review'=> $video->review,
            'diffDate' => $diffDate,

            'question' => $question,
            'otherQuestionsArray' => $otherQuestionsArray,

            'stNickname' => $stNickname,
            'hrName' => $hrName,
            'hrId' => $video->hr_id,
            'stName' => $stName,
            'stId' => $video->st_id,

            'stImagePath' => $stUser->image_path,
            'hrImagePath' => $hrUser->image_path,
          ],
        ]);
      }
      return $videosCollection;
    }
}
