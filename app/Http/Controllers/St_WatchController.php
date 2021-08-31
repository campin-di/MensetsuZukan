<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Common\DiffDateClass;
use App\Common\VideoDisplayClass;
use App\Common\RedirectClass;

use Google_Client;
use Google_Service_YouTube;
use Auth;

use App\Models\User;
use App\Models\HrUser;
use App\Models\Video;

class St_WatchController extends Controller
{
  public function index($id)
  {
    //=====もし視聴不可状態のときはリダイレクト===================================
    if($redirect = RedirectClass::stRedirect()){
      if($redirect){
        return redirect()->action($redirect);
      }
    }
    //==========================================================================

    $ids = [69, 55, 59];
    if(Auth::user()->status == config('const.USER_STATUS.UNAVAILABLE') && !in_array($id, $ids)){
      return redirect()->action('St_HomeController@preContributor');
    }

    if(!session()->has('access')){
      $targetVideo = Video::where('id', $id)->first();
      $targetVideo->views++;
      $targetVideo->save();

      session(['access' => true]);
    } 

    $video = Video::where('id', $id)->get();

    $videosCollection = VideoDisplayClass::VideoDisplay($video);
    $mainVideo = current($videosCollection)[0];

    return view('st.watch',compact('mainVideo'));
  }

}
