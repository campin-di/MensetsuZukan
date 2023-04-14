<?php

namespace app\Common;
use Carbon\Carbon;

use App\Models\User;
use App\Models\HrUser;

class TypeDisplayClass
{
    public static function TypeDisplay($video)
    {
      $st = User::find($video->st_id);
      $hr = HrUser::find($video->hr_id);

      $typeArray = [
        'st' => [
          'id' => $video->st_id,
          'nickname' => $st->nickname,
          'img' => $st->image_path,
          'content' => [
            '志望業界' => $st->industry,
            '志望企業タイプ' => explode('（', $st->company_type)[0],
            '志望職種' => $st->jobtype,
            '大学群' => $st->university_class,
            '卒業年度（見込み）' => $st->graduate_year. '年卒',
            '就活を開始した時期' => $st->start_time,
          ]
        ],
        'hr' => [
          'id' => $video->hr_id,
          'nickname' => $hr->nickname,
          'img' => $hr->image_path,
          'content' => [
            '所属業界' => $hr->industry,
            '本社所在地' => $hr->location,
            '企業タイプ' => explode('（', $hr->company_type)[0],
            '上場区分' => $hr->stock_type,
            '担当選考フェーズ' => $hr->selection_phase,
          ]
        ]
      ];

      return $typeArray;
    }
}
