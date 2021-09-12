<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Google_Client;
use Google_Service_YouTube;

use Auth;

use App\Models\User;
use App\Models\HrUser;
use App\Models\Video;
use App\Models\Interview;
use App\Models\Schedule;

use App\Common\DiffDateClass;
use App\Common\TypeDisplayClass;
use App\Common\ScoringTermsClass;
use App\Common\VideoDisplayClass;
use App\Common\RedirectClass;


class Hr_WatchController extends Controller
{
  public function index($id)
  {
    //=====もし視聴不可状態のときはリダイレクト===================================
    if($redirect = RedirectClass::hrOfferRedirect()){
      if($redirect){
        return redirect()->action($redirect);
      }
    }
    //==========================================================================

    if(!session()->has('access')){
      $targetVideo = Video::where('id', $id)->first();
      $targetVideo->views++;
      $targetVideo->save();

      session(['access' => true]);
    } 

    $video = Video::where('id', $id)->get();

    $videosCollection = VideoDisplayClass::VideoDisplay($video);
    $mainVideo = current($videosCollection)[0];

    $interview = Interview::find($mainVideo['interview_id']);

    $scoringTerms = ScoringTermsClass::scoringTerms();
    $scoringSignals = ScoringTermsClass::scoringSignals();
    $scoreDetailsArray = [];
    $cnt = 1;
    foreach($scoringTerms as $scoringTerm => $termIconArray){
      $colomn = 'score_'. $cnt;
      array_push($scoreDetailsArray, [$termIconArray, $scoringTerm, $scoringSignals[$interview[$colomn]-1]]);
      $cnt++;
    }

    $typeArray = TypeDisplayClass::TypeDisplay($video[0]);

    $flag = Schedule::where('hr_id', Auth::guard('hr')->id())->select('st_id')->groupBy('st_id')->get()->count();

    return view('hr.watch',compact('mainVideo', 'typeArray', 'scoreDetailsArray', 'flag'));
  }
}
