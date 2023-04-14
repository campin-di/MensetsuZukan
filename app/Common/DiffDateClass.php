<?php

namespace app\Common;
use Carbon\Carbon;

class DiffDateClass
{
    public static function diffDate($targetDate)
    {
        $now = new Carbon('today', 'Asia/Tokyo'); // 今
        $today = Carbon::createFromFormat('Y-m-d H:i:s', $now)->format('Y-m-d');
        $targetDate = Carbon::createFromFormat('Y-m-d H:i:s', $targetDate)->format('Y-m-d');

        $today = new Carbon($today);
        $targetDate = new Carbon($targetDate);

        $interval = $targetDate->diffInDays($today);
        if ($interval >= 365) {
          $diffDate =  $targetDate->diffInYears($today) . '年前';
        } else {
          if ($interval >= 30 && $interval < 365) {
            $diffDate = $targetDate->diffInMonths($today) . 'ヶ月前';
          } else {
            if ($interval >= 7 && $interval < 30) {
              $diffDate = $targetDate->diffInWeeks($today) . '週間前';
            } else {
              if ($interval >= 1) {
                $diffDate = $interval . '日前';
              } else {
                $diffDate = '今日';
              }
            }
          }
        }

        return $diffDate;
    }
}
