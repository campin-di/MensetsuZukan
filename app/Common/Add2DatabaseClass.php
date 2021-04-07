<?php

namespace app\Common;
use Carbon\Carbon;

class Add2DatabaseClass
{
    public static function add2Database($data, $target)
    {
      if(is_null($data)){
        return $target;
      }
      return $data.','.$target;
    }
}
