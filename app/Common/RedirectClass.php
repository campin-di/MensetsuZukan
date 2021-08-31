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
          //return "St_HomeController@preContributor";
          return 0;
        } else {
          //return "St_HomeController@preAudience";
          return 0;
        }
      }elseif($user->status == config('const.USER_STATUS.MAIL_AUTHED') ||
              $user->status == config('const.USER_STATUS.PRE_REGISTER') ||
              $user->status == config('const.USER_STATUS.REGISTER')){
          return "St_HomeController@preRegister";
      }
      else return 0;
    }

    public static function hrPreRegisterRedirect()
    {
      $userId = Auth::guard('hr')->id();
      $user = HrUser::find($userId);

      if($user->status == config('const.USER_STATUS.MAIL_AUTHED') ||
      $user->status == config('const.USER_STATUS.PRE_REGISTER') ||
      $user->status == config('const.USER_STATUS.REGISTER')){
        return "Hr\HrHomeController@preRegister";
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
          return "Hr\HrHomeController@preHr";
        } else {
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
          return "Hr\HrHomeController@preOffer";
        }
      }else{
          return 0;
      }
    }

}
