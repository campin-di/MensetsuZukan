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
        $total_score_integer = floor($total_score);
        $total_score_double = round(($total_score - $total_score_integer)*1000, 3);

        $videosCollection = $videosCollection->concat([
          [
            'id' => $video->id,
            'vimeo_src' => $video->vimeo_src,
            'thumbnail_path' => $video->thumbnail_path,
            'title' => $video->title,
            
            'basic_score' => $video->basic_score,
            'expression_score' => $video->expression_score,
            'logical_score' => $video->logical_score,
            'vitality_score' => $video->vitality_score,
            'creative_score' => $video->creative_score,
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
}
