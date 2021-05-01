<?php

namespace app\Common;
use Carbon\Carbon;
use Auth;
Use Redirect;

class RedirectClass
{
    public static function stRedirect()
    {
      $user = Auth::user();
      if($user->status == config('const.USER_STATUS.UNAVAILABLE')){
        if($user->plan == 'contributor'){
          //return redirect()->action("St_HomeController@preContributor");
          return "St_HomeController@preContributor";
        } else {
          //return redirect()->action("St_HomeController@preAudience");
          return "St_HomeController@preAudience";
        }
      }else{
          return 0;
      }
    }
}
