<?php

namespace app\Common;
use Carbon\Carbon;
use Auth;
Use Redirect;

use App\Models\HrUser;

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

    public static function hrRedirect()
    {
      $userId = Auth::guard('hr')->id();
      $user = HrUser::find($userId);

      if($user->status == config('const.USER_STATUS.UNAVAILABLE')){
        if($user->plan == 'hr'){
          //return redirect()->action("St_HomeController@preContributor");
          return "Hr\HrHomeController@preHr";
        } else {
          //return redirect()->action("St_HomeController@preAudience");
          return "Hr\HrHomeController@preOffer";
        }
      }else{
          return 0;
      }
    }

    public static function hrOfferRedirect()
    {
      $userId = Auth::guard('hr')->id();
      $user = HrUser::find($userId);

      if($user->status == config('const.USER_STATUS.UNAVAILABLE')){
        if($user->plan == 'offer'){
          //return redirect()->action("St_HomeController@preAudience");
          return "Hr\HrHomeController@preOffer";
        }
      }else{
          return 0;
      }
    }

}
