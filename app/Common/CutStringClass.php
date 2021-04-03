<?php

namespace app\Common;
use Carbon\Carbon;

class CutStringClass
{
    public static function CutString($target, $limit)
    {
      //===limit個以上の文字を･･･に置き換える関数=====
      if(mb_strlen($target) > $limit) {
        $tmp = mb_substr($target,0,$limit);
        $target = "$tmp ... ";
      }

        return $target;
    }
}
