<?php

namespace app\Common;
use Carbon\Carbon;

class SessionFormClass
{
    public static function Return2form($request, $controllerName)
    {
      //セッションから値を取り出す
      $input = $request->session()->get("input");

      //戻るボタンが押された時
      if($request->has("back")){
        return redirect()->action($controllerName . "@show")
          ->withInput($input);
      }

      //セッションに値が無い時はフォームに戻る
      if(!$input){
        return redirect()->action("$controllerName . @show");
      }
      return $input;
    }

    public static function confirm($request, $controllerName){
      //セッションから値を取り出す
      $input = $request->session()->get("input");

      //セッションに値が無い時はフォームに戻る
      if(!$input){
        return redirect()->action($controllerName . "@show");
      }
      return $input;
    }
}
