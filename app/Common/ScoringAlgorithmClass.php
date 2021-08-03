<?php

namespace app\Common;
use Carbon\Carbon;

class ScoringAlgorithmClass
{
    public static function scoringAlgorithm($interview)
    {
      for($i=1; $i<=10; $i++){
        $score = 'score_'.$i;
        if($interview->$score != 4){
          if($i%2 == 0){
            ${$score} = $interview->$score - 0.1 - ($i * 0.003);
          }else{
            ${$score} = $interview->$score + 0.1 + ($i * 0.003);
          }
        }else{
          ${'score_'.$i} = 4.000;
        }
      }

      $basicScore = ($score_1 * 2) + $score_2 + ($score_3 * 2) + ($score_4 * 2) + $score_5;
      $logicalScore = ($score_3 * 2) + ($score_4 * 2);
      $expressionScore = $score_2 + $score_6 + ($score_7 * 2) + $score_8;
      $vitalityScore = $score_5 + $score_6 + $score_8 + $score_9;
      $creativeScore = ($score_7 * 2) + ($score_10 * 2);

      $scores = [
        "basic" => $basicScore, 
        "expression" => $expressionScore, 
        "logical" => $logicalScore, 
        "vitality" => $vitalityScore, 
        "creative" => $creativeScore
      ];
      
      return $scores;
    }
}
