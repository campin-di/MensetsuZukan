<?php

namespace app\Common;
use Carbon\Carbon;
use App\Models\Video;

class ScoringTermsClass
{
    public static function scoringTerms()
    {
      $array = [
        "敬語や口癖に違和感がなく、話し方が適切である。" => ['basic'],
        "身だしなみや表情、声の抑揚等非言語の印象が良い。" => ['basic', 'expression'],
        "質問の意図が理解でき回答が的確、間のとり方が良い。" => ['basic', 'logical', 'creative'],
        "回答スピードが早く、簡潔にまとまっている。" => ['basic', 'logical'],
        "変な緊張や焦りがなく落ち着いて話せている。" => ['basic', 'vitality'],
        "価値観、性格、感情が伝えることができる。" => ['expression', 'vitality'],
        "自分なりの価値や工夫を見いだし、差別化できる。" => ['logical', 'expression', 'creative'],
        "自ら意思決定した選択や行動が多い。" => ['expression', 'vitality'],
        "やると決めたことは継続してやり抜く。" => ['vitality'],
        "知的好奇心やひらめきから行動に移せる。" => ['creative'],
      ];
      return $array;
    }

    public static function scoringSignals()
    {
      $array = [
       "×",
       "△",
       "○",
       "◎",
      ];
      return $array;
    }

    public static function scoringDetails($video)
    {
      $allScoreDetails = [
        'basic' => [
          [ // 0 ~ 19
            'title' => '面接基礎力',
            'feature' => '現在準備中です。',
            'measure' => '現在準備中です。',
            'content' => '10',
          ],
          [ // 20 ~ 39
            'title' => '面接基礎力',
            'feature' => '現在準備中です。',
            'measure' => '現在準備中です。',
            'content' => '10',
          ],
          [ // 40 ~ 59
            'title' => '面接基礎力',
            'feature' => '現在準備中です。',
            'measure' => '現在準備中です。',
            'content' => '10',
          ],
          [ // 60 ~ 79
            'title' => '面接基礎力',
            'feature' => '現在準備中です。',
            'measure' => '現在準備中です。',
            'content' => '10',
          ],
          [ // 80 ~ 99
            'title' => '面接基礎力',
            'feature' => '現在準備中です。',
            'measure' => '現在準備中です。',
            'content' => '10',
          ],
          [ // 100
            'title' => '面接基礎力',
            'feature' => '現在準備中です。',
            'measure' => '現在準備中です。',
            'content' => '10',
          ],
        ],
        'expression' => [
          [ // 0 ~ 19
            'title' => '自己表現力',
            'feature' => '現在準備中です。',
            'measure' => '現在準備中です。',
            'content' => '10',
          ],
          [ // 20 ~ 39
            'title' => '自己表現力',
            'feature' => '現在準備中です。',
            'measure' => '現在準備中です。',
            'content' => '10',
          ],
          [ // 40 ~ 59
            'title' => '自己表現力',
            'feature' => '現在準備中です。',
            'measure' => '現在準備中です。',
            'content' => '10',
          ],
          [ // 60 ~ 79
            'title' => '自己表現力',
            'feature' => '現在準備中です。',
            'measure' => '現在準備中です。',
            'content' => '10',
          ],
          [ // 80 ~ 99
            'title' => '自己表現力',
            'feature' => '現在準備中です。',
            'measure' => '現在準備中です。',
            'content' => '10',
          ],
          [ // 100
            'title' => '自己表現力',
            'feature' => '現在準備中です。',
            'measure' => '現在準備中です。',
            'content' => '10',
          ],
        ],
        'logical' => [
          [ // 0 ~ 19
            'title' => 'ロジカル力',
            'feature' => '現在準備中です。',
            'measure' => '現在準備中です。',
            'content' => '10',
          ],
          [ // 20 ~ 39
            'title' => 'ロジカル力',
            'feature' => '現在準備中です。',
            'measure' => '現在準備中です。',
            'content' => '10',
          ],
          [ // 40 ~ 59
            'title' => 'ロジカル力',
            'feature' => '現在準備中です。',
            'measure' => '現在準備中です。',
            'content' => '10',
          ],
          [ // 60 ~ 79
            'title' => 'ロジカル力',
            'feature' => '現在準備中です。',
            'measure' => '現在準備中です。',
            'content' => '10',
          ],
          [ // 80 ~ 99
            'title' => 'ロジカル力',
            'feature' => '現在準備中です。',
            'measure' => '現在準備中です。',
            'content' => '10',
          ],
          [ // 100
            'title' => 'ロジカル力',
            'feature' => '現在準備中です。',
            'measure' => '現在準備中です。',
            'content' => '10',
          ],
        ],
        'vitality' => [
          [ // 0 ~ 19
            'title' => 'バイタリティ',
            'feature' => '現在準備中です。',
            'measure' => '現在準備中です。',
            'content' => '10',
          ],
          [ // 20 ~ 39
            'title' => 'バイタリティ',
            'feature' => '現在準備中です。',
            'measure' => '現在準備中です。',
            'content' => '10',
          ],
          [ // 40 ~ 59
            'title' => 'バイタリティ',
            'feature' => '現在準備中です。',
            'measure' => '現在準備中です。',
            'content' => '10',
          ],
          [ // 60 ~ 79
            'title' => 'バイタリティ',
            'feature' => '現在準備中です。',
            'measure' => '現在準備中です。',
            'content' => '10',
          ],
          [ // 80 ~ 99
            'title' => 'バイタリティ',
            'feature' => '現在準備中です。',
            'measure' => '現在準備中です。',
            'content' => '10',
          ],
          [ // 100
            'title' => 'バイタリティ',
            'feature' => '現在準備中です。',
            'measure' => '現在準備中です。',
            'content' => '10',
          ],
        ],
        'creative' => [
          [ // 0 ~ 19
            'title' => '創造力',
            'feature' => '現在準備中です。',
            'measure' => '現在準備中です。',
            'content' => '10',
          ],
          [ // 20 ~ 39
            'title' => '創造力',
            'feature' => '現在準備中です。',
            'measure' => '現在準備中です。',
            'content' => '10',
          ],
          [ // 40 ~ 59
            'title' => '創造力',
            'feature' => '現在準備中です。',
            'measure' => '現在準備中です。',
            'content' => '10',
          ],
          [ // 60 ~ 79
            'title' => '創造力',
            'feature' => '現在準備中です。',
            'measure' => '現在準備中です。',
            'content' => '10',
          ],
          [ // 80 ~ 99
            'title' => '創造力',
            'feature' => '現在準備中です。',
            'measure' => '現在準備中です。',
            'content' => '10',
          ],
          [ // 100
            'title' => '創造力',
            'feature' => '現在準備中です。',
            'measure' => '現在準備中です。',
            'content' => '10',
          ],

        ],
      ];

      $basicAveRate = round((Video::avg('basic_score') / 32) * 100);
      $expressionAveRate = round((Video::avg('expression_score') / 20) * 100);
      $logicalAveRate = round((Video::avg('logical_score') / 16) * 100);
      $vitalityAveRate = round((Video::avg('vitality_score') / 16) * 100);
      $creativeAveRate = round((Video::avg('creative_score') / 16) * 100);

      $basicRate = round(($video->basic_score / 32) * 100);
      $expressionRate = round(($video->expression_score / 20) * 100);
      $logicalRate = round(($video->logical_score / 16) * 100);
      $vitalityRate = round(($video->vitality_score / 16) * 100);
      $creativeRate = round(($video->creative_score / 16) * 100);
            
      $basicRateIndex = floor($basicRate/20);
      $expressionRateIndex = floor($expressionRate/20);
      $logicalRateIndex = floor($logicalRate/20);
      $vitalityRateIndex = floor($vitalityRate/20);
      $creativeRateIndex = floor($creativeRate/20);

      $retDetailsArray = [
        'basic' => $allScoreDetails['basic'][$basicRateIndex],
        'expression' => $allScoreDetails['expression'][$expressionRateIndex],
        'logical' => $allScoreDetails['logical'][$logicalRateIndex],
        'vitality' => $allScoreDetails['vitality'][$vitalityRateIndex],
        'creative' => $allScoreDetails['creative'][$creativeRateIndex],
      ];

      $retDetailsArray['basic'] += ['rate' => $basicRate];
      $retDetailsArray['expression'] += ['rate' => $expressionRate];
      $retDetailsArray['logical'] += ['rate' => $logicalRate];
      $retDetailsArray['vitality'] += ['rate' => $vitalityRate];
      $retDetailsArray['creative'] += ['rate' => $creativeRate];

      $retDetailsArray['basic'] += ['ave' => $basicAveRate];
      $retDetailsArray['expression'] += ['ave' => $expressionAveRate];
      $retDetailsArray['logical'] += ['ave' => $logicalAveRate];
      $retDetailsArray['vitality'] += ['ave' => $vitalityAveRate];
      $retDetailsArray['creative'] += ['ave' => $creativeAveRate];

      return $retDetailsArray;
    }
}
