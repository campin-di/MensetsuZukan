<?php

namespace app\Common;
use Carbon\Carbon;

use App\Models\User;
use App\Models\HrUser;
use App\Models\Video;
use App\Models\Question;

use App\Common\DiffDateClass;

class VideoDisplayClass
{
    public static function VideoDisplay($videos)
    {
      $count = $videos->count();

      $videosCollection = collect([]);
      foreach ($videos as $video) {

        $diffDate = DiffDateClass::diffDate($video->created_at);

        $stUsername = User::find($video->st_id)->username;
        $hrName = HrUser::find($video->hr_id)->name;

        $question = Question::find($video->question_id)->name;
        $otherQuestionsArray = Video::with('question')->where('common_url', $video->common_url)->where('question_id', '!=', $video->question_id)->select('question_id')->get();

        $videosCollection = $videosCollection->concat([
          [
            'id' => $video->id,
            'url' => $video->url,
            'title' => $video->title,
            'score' => $video->score,
            'views' => $video->views,
            'good'  => $video->good,
            'review'=> $video->review,
            'diffDate' => $diffDate,

            'question' => $question,
            'otherQuestionsArray' => $otherQuestionsArray,

            'stUsername' => $stUsername,
            'hrName' => $hrName,
          ],
        ]);
      }
      return $videosCollection;
    }
}
