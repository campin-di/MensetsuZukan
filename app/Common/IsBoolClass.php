<?php

namespace app\Common;
use Carbon\Carbon;

class IsBoolClass
{
    public static function isBool($target, $array)
    {
      if(in_array($target, $array, true)){
        return 1;
      }
      return 0;
    }
}
