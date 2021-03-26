<?php

namespace app\Common;
use Carbon\Carbon;

use App\Models\User;
use App\Models\HrUser;
use App\Models\Video;

use App\Common\DiffDateClass;

class VideoDisplayClass
{
    public static function VideoDisplay($videos)
    {
      $count = $videos->count();

      $videosCollection = collect([]);
      foreach ($videos as $video) {

        $diffDate = DiffDateClass::diffDate($video->created_at);
        $otherQuestions = Video::where('common_url', $video->common_url)->where('question', '!=', $video->question)->groupBy('question')->get('question');

        $stUsername = User::find($video->st_id)->username;
        $hrName = HrUser::find($video->hr_id)->name;

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

            'question' => $video->question,
            'otherQuestions' => $otherQuestions,

            'stUsername' => $stUsername,
            'hrName' => $hrName,
          ],
        ]);
      }
      return $videosCollection;
    }
}
