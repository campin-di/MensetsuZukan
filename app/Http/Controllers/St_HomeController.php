<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Common\RedirectClass;
use DateTime;
use Auth;

use App\Models\Video;
use App\Models\Question;

use App\Common\VideoDisplayClass;

class St_HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    //=====もし視聴不可状態のときはリダイレクト===================================
    if($redirect = RedirectClass::stRedirect()){
      return redirect()->action($redirect);
    }
    //==========================================================================

    $questionsData = Question::get('name');
    $questions = [];
    foreach ($questionsData as $question) {
      array_push($questions, $question->name);
    }

    $videos = Video::get();
    $videosCollection = VideoDisplayClass::VideoDisplay($videos);

    return view('home',[
      'questions' => $questions,
      'videosCollection' => $videosCollection,
    ]);
  }

  public function preContributor()
  {

    return view('unavailable.contributor',[
    ]);
  }

  public function preAudience()
  {

    return view('unavailable.audience',[
    ]);
  }

}
