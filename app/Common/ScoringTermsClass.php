<?php

namespace app\Common;
use Carbon\Carbon;

class ScoringTermsClass
{
    public static function scoringTerms()
    {
      $array = [
        "敬語や口癖に違和感がなく、話し方が適切である。",
        "身だしなみや表情、声の抑揚等非言語の印象が良い。",
        "質問の意図が理解でき回答が的確、間のとり方が良い。",
        "回答スピードが早く、簡潔にまとまっている。",
        "変な緊張や焦りがなく落ち着いて話せている。",
        "価値観、性格、感情が伝えることができる。",
        "自分なりの価値や工夫を見いだし、差別化できる。",
        "自ら意思決定した選択や行動が多い。",
        "やると決めたことは継続してやり抜く。",
        "知的好奇心やひらめきから行動に移せる。",
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
