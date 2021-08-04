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

        $total_score = $video->basic_score + $video->expression_score + $video->logical_score + $video->vitality_score + $video->creative_score;
        $total_scores = self::cutDecimal($total_score);

        $basic_scores = self::cutDecimal($video->basic_score);
        $expression_scores = self::cutDecimal($video->expression_score);
        $logical_scores = self::cutDecimal($video->logical_score);
        $vitality_scores = self::cutDecimal($video->vitality_score);
        $creative_scores = self::cutDecimal($video->creative_score);

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
            'total_score_integer' => $total_scores[0],
            'total_score_double' => $total_scores[1],
            'views' => $video->views,
            'good'  => $video->good,
            'review_good'=> $video->review_good,
            'review_more'=> $video->review_more,
            'diffDate' => $diffDate,

            'question' => $question,
            'otherQuestionsArray' => $otherQuestionsArray,

            'stNickname' => $stUser->nickname,
            'hrNickname' => $hrUser->nickname,

            'stIndustry' => $stUser->industry,
            'stCompanyType' => $stCompanyType,
            'stJobType' => $stUser->jobtype,
            'stUniversityClass' => $stUser->university_class,
            'stFaculty' => $stUser->faculty,
            'stGraduateYear' => $stUser->graduate_year. '年卒',
            'stStartTime' => $stUser->start_time,
            
            'hrSelectionPhase' => $hrUser->selection_phase,
            'hrIndustry' => $hrUser->industry,
            'hrCompanyType' => $hrCompanyType,
            'hrStockType' => $hrUser->stock_type,
            'hrLocation' => $hrUser->location,

            'hrId' => $video->hr_id,
            'stId' => $video->st_id,

            'stImagePath' => $stUser->image_path,
            'hrImagePath' => $hrUser->image_path,
          ],
        ]);
      }
      return $videosCollection;
    }
    public static function cutDecimal($score)
    {
      $score_integer = floor($score);
      $score_double = round(($score - $score_integer)*1000, 3);

      $scoreArray = [$score_integer, $score_double];

      return $scoreArray;
    }

}
