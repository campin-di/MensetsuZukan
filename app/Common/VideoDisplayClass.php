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
        $stCompanyType = explode('（', $stUser->company_type)[0];
        $hrUser = HrUser::find($video->hr_id);
        $hrCompanyType = explode('（', $hrUser->company_type)[0];
        $question = Question::find($video->question_1_id)->name;
        $otherQuestionsArray = [Question::find($video->question_1_id)->name, Question::find($video->question_2_id)->name, Question::find($video->question_3_id)->name];

        
        $basic_scores = self::cutDecimal($video->basic_score, 32);
        $expression_scores = self::cutDecimal($video->expression_score, 20);
        $logical_scores = self::cutDecimal($video->logical_score, 16);
        $vitality_scores = self::cutDecimal($video->vitality_score, 16);
        $creative_scores = self::cutDecimal($video->creative_score, 16);

        $total_score_double = $basic_scores[1] + $expression_scores[1] + $logical_scores[1] + $vitality_scores[1] + $creative_scores[1];
        $digitUp = floor($total_score_double / 1000);
        $total_score_double = $total_score_double % 1000;

        $total_score_integer = $basic_scores[0] + $expression_scores[0] + $logical_scores[0] + $vitality_scores[0] + $creative_scores[0] + $digitUp;
        
        $videosCollection = $videosCollection->concat([
          [
            'id' => $video->id,
            'vimeo_src' => $video->vimeo_src,
            'thumbnail_path' => $video->thumbnail_path,
            'title' => $video->title,
            
            'basic_score_integer' => $basic_scores[0],
            'basic_score_double' => $basic_scores[1],
            'expression_score_integer' => $expression_scores[0],
            'expression_score_double' => $expression_scores[1],
            'logical_score_integer' => $logical_scores[0],
            'logical_score_double' => $logical_scores[1],
            'vitality_score_integer' => $vitality_scores[0],
            'vitality_score_double' => $vitality_scores[1],
            'creative_score_integer' => $creative_scores[0],
            'creative_score_double' => $creative_scores[1],
            'total_score_integer' => $total_score_integer,
            'total_score_double' => $total_score_double,
            'views' => $video->views,
            'good'  => $video->good,
            'review_good'=> $video->review_good,
            'review_more'=> $video->review_more,
            'diffDate' => $diffDate,

            'question' => $question,
            'otherQuestionsArray' => $otherQuestionsArray,

            'stNickname' => $stUser->nickname,
            'hrNickname' => $hrUser->nickname,

            'hrId' => $video->hr_id,
            'stId' => $video->st_id,

            'type' => $video->type,

            'interview_id' => $video->interview_id,

            'stImagePath' => $stUser->image_path,
            'hrImagePath' => $hrUser->image_path,
          ],
        ]);
      }
      return $videosCollection;
    }

    public static function cutDecimal($score, $max)
    {
      $score = self::addPoints($score, $max);
     
      $score_integer = floor($score);
      $score_double = round(($score - $score_integer)*1000);
      
      $scoreArray = [$score_integer, $score_double];
      
      return $scoreArray;
    }
    
    public static function addPoints($score, $max){
      $addPoint = 0.3 * ($max - $score);
      return $score + $addPoint;      
    }

  }
