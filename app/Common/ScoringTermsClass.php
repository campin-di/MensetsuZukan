<?php

namespace app\Common;
use Carbon\Carbon;

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
}
