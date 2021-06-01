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
      $videosCollection = collect([]);
      foreach ($videos as $video) {

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
