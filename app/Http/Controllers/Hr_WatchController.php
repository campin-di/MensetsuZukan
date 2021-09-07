<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Common\DiffDateClass;

use App\Models\User;
use App\Models\HrUser;
use App\Models\Video;
use App\Models\Interview;

use App\Common\ScoringTermsClass;
use App\Common\VideoDisplayClass;
use App\Common\RedirectClass;

use Google_Client;
use Google_Service_YouTube;

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

    $video = Video::where('id', $id)->get();

    $videosCollection = VideoDisplayClass::VideoDisplay($video);
    $mainVideo = current($videosCollection)[0];

    $interview = Interview::find($mainVideo['interview_id']);

    $scoringTerms = ScoringTermsClass::scoringTerms();
    $scoringSignals = ScoringTermsClass::scoringSignals();
    $scoreDetailsArray = [];
    $cnt = 1;
    foreach($scoringTerms as $scoringTerm){
      $colomn = 'score_'. $cnt;
      array_push($scoreDetailsArray, [$scoringTerm, $scoringSignals[$interview[$colomn]-1]]);
      $cnt++;
    }

    return view('hr.watch',compact('mainVideo', 'scoreDetailsArray'));
  }
}
