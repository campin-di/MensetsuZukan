<?php

namespace app\Common;
use Carbon\Carbon;

class ReturnTimeArrayClass
{
    public static function returnTimeArray()
    {
      $timeArray = [
        'nine' => "9:00 - 10:00",
        'ten' => "10:00 - 11:00",
        'eleven' => "11:00 - 12:00",
        'twelve' => "12:00 - 13:00",
        'thirteen' => "13:00 - 14:00",
        'fourteen' => "14:00 - 15:00",
        'fifteen' => "15:00 - 16:00",
        'sixteen' => "16:00 - 17:00",
        'seventeen' => "17:00 - 18:00",
        'eighteen' => "18:00 - 19:00",
        'nineteen' => "19:00 - 20:00",
        'twenty' => "20:00 - 21:00",
        'twentyone' => "21:00 - 22:00"
      ];
      return $timeArray;
    }
}
