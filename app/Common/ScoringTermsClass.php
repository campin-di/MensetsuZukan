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
          [ // 25 ~ 49
            'title' => '面接基礎力',
            'feature' => '話し方や印象が良くなかったり、頻出質問の事前準備など基礎がまだできていない傾向が強いです。',
            'measure' => '録画された面接動画を見直して、話し方の癖を直す/身だしなみを整える/表情を明るくするなど印象を管理しましょう。自己分析と頻出質問への回答はまとめて整理し、会話が苦手な人は口語でまとめてみましょう。',
            'content' => '10',
          ],
          [ // 50 ~ 69
            'title' => '面接基礎力',
            'feature' => '面接官によって話し方や印象は懸念に感じたり、深堀り質問に対して答えられない傾向がみられます。',
            'measure' => '適切な敬語が使えているか、口語に違和感がないか面接動画を見直して改善しましょう。質問の回答に対するWhyやHowの深堀り質問には答えられるようにしましょう。',
            'content' => '10',
          ],
          [ // 70 ~ 79
            'title' => '面接基礎力',
            'feature' => '面接の基本はできていると評価される傾向があります。一次面接レベルなら通過の可能性が高いでしょう。',
            'measure' => '面接動画を見直し、声の抑揚や表情、身だしなみなどすぐ改善できる印象は改善しましょう。面接にもっと慣れるために模擬面接を重ねるとより面接でのパフォーマンスが安定します。',
            'content' => '10',
          ],
          [ // 80 ~ 95
            'title' => '面接基礎力',
            'feature' => '言語/非言語ともに面接の基礎がしっかりできており高く評価する面接官は多い傾向が強いです。一次～最終面接通して通過の可能性が高いでしょう。。',
            'measure' => 'どんなパターンの面接でも緊張しないように様々なタイプの面接官と模擬面接を重ねましょう。',
            'content' => '10',
          ],
          [ // 95 ~ 100
            'title' => '面接基礎力',
            'feature' => '言語/非言語ともに面接の基礎は完璧です。一次～最終面接通して通過の可能性がとても高いでしょう。',
            'measure' => 'どんな面接官でもこの数字をキープできるか模擬面接を重ねてみましょう！',
            'content' => '10',
          ],
        ],
        'expression' => [
          [ // 25 ~ 49
            'title' => '自己表現力',
            'feature' => 'あなたらしい価値観や性格が面接官に伝わっていない傾向が強いです。',
            'measure' => '回答の背景や理由にあなたの感情や価値観をいれて話すようにしましょう。',
            'content' => '10',
          ],
          [ // 50 ~ 69
            'title' => '自己表現力',
            'feature' => '性格や価値観に一貫性がないと評価される傾向がみられます。',
            'measure' => 'エピソードごとに違った強み弱みを話していないか、面接での言動と伝えている内容にギャップがないか、確認し改善しましょう。第三者から見える自分をヒアリングすると整理しやすくなります。',
            'content' => '10',
          ],
          [ // 70 ~ 79
            'title' => '自己表現力',
            'feature' => '性格や価値観がある程度一貫して伝わっている傾向があります。面接官が一緒に働きたいと思える自己表現までもう一歩でしょう。',
            'measure' => '「継続力」や「好奇心」など一般的な言葉を多用していないか確認し、他者と差別化できるあなたらしい言葉で表現できるかチャレンジしてみましょう。',
            'content' => '10',
          ],
          [ // 80 ~ 95
            'title' => '自己表現力',
            'feature' => '性格や価値観が言葉として表現でき、ある程度一貫性が伝わっており、印象が良いと評価される傾向が強いです。',
            'measure' => '模擬面接を重ねて、どんな面接官でも臆せず本心から自己表現できるようにしましょう。',
            'content' => '10',
          ],
          [ // 95 ~ 100
            'title' => '自己表現力',
            'feature' => '性格や価値観を言語/非言語ともに表現でき、エピソードとの一貫性もあります。印象がとても良く一緒に働きたいと思える面接官がほとんどでしょう。',
            'measure' => 'どんな面接官でもこの数字をキープできるか模擬面接を重ねてみましょう！',
            'content' => '10',
          ],
        ],
        'logical' => [
          [ // 25 ~ 49
            'title' => 'ロジカル力',
            'feature' => '会話内容の理解が難しく、回答が遠回り/時間が長かったり、質問の意図から回答がずれる傾向が強いです。',
            'measure' => 'まずは頻出質問に対する回答は事前に簡潔にまとめて準備しましょう。質問に対する結論を最初に話し、そのあと理由や具体内容を話すという流れを徹底するとなお良いです。',
            'content' => '10',
          ],
          [ // 50 ~ 69
            'title' => 'ロジカル力',
            'feature' => '会話内容が曖昧だがイメージできる。ある程度まとまった回答ができる。',
            'measure' => '初対面の相手に話すことを前提に程度や規模感などは定量で表現し、共通イメージを持つことを心がけましょう。ガクチカなど頻出質問は念入りに準備しましょう。',
            'content' => '10',
          ],
          [ // 70 ~ 79
            'title' => 'ロジカル力',
            'feature' => '会話内容が環境や難易度等までイメージでき、質問の意図からずれずに回答できています。話が冗長になったり、分かりにくい部分が一部ありそうです。',
            'measure' => '深堀り質問に対しても結論から簡潔に答えられるか、模擬面接を重ねて対応力をもっと上げていくと良いでしょう。',
            'content' => '10',
          ],
          [ // 80 ~ 95
            'title' => 'ロジカル力',
            'feature' => '会話がかなりスムーズでストレスを感じさせず、回答が簡潔で分かりやすいです。深堀り質問にも毅然と回答ができているようです。',
            'measure' => '模擬面接を重ねて、抽象度が高かったり苦手な質問に対する対策を積んでいきましょう。',
            'content' => '10',
          ],
          [ // 95 ~ 100
            'title' => 'ロジカル力',
            'feature' => '会話のテンポが良く心地よいです。回答も質問の意図を的確にとらえており、抽象度の高い内容もわかりやすく面接官に伝わっています。ビジネスレベルで通用するでしょう。',
            'measure' => 'どんな面接官でもこの数字をキープできるか模擬面接を重ねてみましょう！',
            'content' => '10',
          ],
        ],
        'vitality' => [
          [ // 25 ~ 49
            'title' => 'バイタリティ',
            'feature' => '物事に対する熱量の高さや主体性が面接官に伝わっていない傾向が強いです。',
            'measure' => '面接動画を見直し、理由や動機で消極的な内容を話していないか/環境に左右されすぎていないかなどネガティブポイントを改善しましょう。',
            'content' => '10',
          ],
          [ // 50 ~ 69
            'title' => 'バイタリティ',
            'feature' => '物事に対する熱量の高さや主体性がありそうなものの、面接官に伝わりきっていない傾向がみられます。',
            'measure' => '熱量の高さが伝わる背景や感情表現ができているか、また組織に関することでも自分が主語で話せているか面接動画を確認しましょう。',
            'content' => '10',
          ],
          [ // 70 ~ 79
            'title' => 'バイタリティ',
            'feature' => '物事に対する熱量の高さや主体性があると評価される傾向があります。',
            'measure' => '熱量の高さやレベル感を説明できているか、逆境や課題を前にしても前向きに取り組みやりぬいた姿勢を伝えられているか確認しましょう。',
            'content' => '10',
          ],
          [ // 80 ~ 95
            'title' => 'バイタリティ',
            'feature' => '物事に対する熱量の高さや主体性があり、やりきる力やプレッシャー耐性含め高く評価される傾向があります。',
            'measure' => '模擬面接を重ねてどんなエピソードでも熱量の高さや主体性を伝えられるようにしましょう。',
            'content' => '10',
          ],
          [ // 95 ~ 100
            'title' => 'バイタリティ',
            'feature' => '物事に取り組む熱量の高さや主体性、やりきる力やプレッシャー耐性がかなり高く評価されています。',
            'measure' => 'どんな面接官でもこの数字をキープできるか模擬面接を重ねてみましょう！',
            'content' => '10',
          ],
        ],
        'creative' => [
          [ // 25 ~ 49
            'title' => '創造力',
            'feature' => '枠にはまった物事の見方をし、一般的なルールや正解を求める傾向が強いです。',
            'measure' => 'あなたの性格やスキルで実現できたことや、ひらめきや好奇心から行動にうつしてみたエピソードがないか、自己分析を深めましょう。',
            'content' => '10',
          ],
          [ // 50 ~ 69
            'title' => '創造力',
            'feature' => '他者と差別化できるあなたなりの価値や工夫が伝わっていない傾向がみられます。',
            'measure' => 'あなたの性格からくる強みやスキルで生み出した価値や工夫をエピソードの中にいれて話しましょう。どんなに些細なことでも堂々と話すことがポイントです。',
            'content' => '10',
          ],
          [ // 70 ~ 79
            'title' => '創造力',
            'feature' => '他者と差別化できる価値や工夫が伝わっていると評価される傾向があります。',
            'measure' => '生み出している価値や工夫が客観的にとらえても価値やオリジナリティが高いと思えるレベルまで表現を磨きましょう。',
            'content' => '10',
          ],
          [ // 80 ~ 95
            'title' => '創造力',
            'feature' => '既存のフレームにとらわれず多角的に物事を考え他者と差別化できる価値工夫を生み出す発想力がある、と評価される傾向があります。',
            'measure' => '模擬面接を重ねて、自分なりの価値工夫や差別化を意識して話せるエピソードを増やしましょう。',
            'content' => '10',
          ],
          [ // 95 ~ 100
            'title' => '創造力',
            'feature' => '既存のフレームにとらわれず多角的に物事を考え、他者と差別化できる価値工夫を生み出す発想力がかなり高く評価されています。',
            'measure' => 'どんな面接官でもこの数字をキープできるか模擬面接を重ねてみましょう！',
            'content' => '10',
          ],
        ],
      ];

      $basicAveRate = round((Video::avg('basic_score') / 32) * 100);
      $expressionAveRate = round((Video::avg('expression_score') / 20) * 100);
      $logicalAveRate = round((Video::avg('logical_score') / 16) * 100);
      $vitalityAveRate = round((Video::avg('vitality_score') / 16) * 100);
      $creativeAveRate = round((Video::avg('creative_score') / 16) * 100);

      $basicRate = round(($video['basic_score_integer'] / 32) * 100);
      $expressionRate = round(($video['expression_score_integer'] / 20) * 100);
      $logicalRate = round(($video['logical_score_integer'] / 16) * 100);
      $vitalityRate = round(($video['vitality_score_integer'] / 16) * 100);
      $creativeRate = round(($video['creative_score_integer'] / 16) * 100);
            
      
      $basicRateIndex = self::rate2index($basicRate);
      $expressionRateIndex = self::rate2index($expressionRate);
      $logicalRateIndex = self::rate2index($logicalRate);
      $vitalityRateIndex = self::rate2index($vitalityRate);
      $creativeRateIndex = self::rate2index($creativeRate);

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

    public static function rate2index($scoreRate)
    {
      if($scoreRate >= 95){
        return 4;
      } else if($scoreRate >= 80){
        return 3;
      } else if($scoreRate >= 70){
        return 2;
      } else if($scoreRate >= 50){
        return 1;
      } else{
        return 0;
      }
    }

    
}
