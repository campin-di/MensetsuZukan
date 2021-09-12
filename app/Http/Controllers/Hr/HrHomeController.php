<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;

use Auth;
use App\Models\Video;
use App\Models\Question;
use App\Models\Schedule;

use App\Common\RedirectClass;
use App\Common\VideoDisplayClass;

class HrHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:hr');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      //=====もし視聴不可状態のときはリダイレクト===================================
      if($redirect = RedirectClass::hrPreRegisterRedirect()){
        if($redirect){
          return redirect()->action($redirect);
        }
      }
      //==========================================================================

      $questionsData = Question::get('name');
      $questions = [];
      foreach ($questionsData as $question) {
        array_push($questions, $question->name);
      }

      $videos = Video::latest()->where('type', config('const.STHR.HR'))->whereHas('User', function($q){
        $q->whereNotIn('graduate_year', ['2022']);
      })->get();

      $videosCollection = VideoDisplayClass::VideoDisplay($videos);
      $flag = Schedule::where('hr_id', Auth::guard('hr')->id())->select('st_id')->groupBy('st_id')->get()->count();

      return view('hr.home',[
        'questions' => $questions,
        'videosCollection' => $videosCollection,
        'flag' => $flag,
      ]);
    }

    public function preHr()
    {

      return view('hr.unavailable.hr',[
      ]);
    }

    public function preOffer()
    {

      return view('hr.unavailable.offer',[
      ]);
    }

    public function preRegister()
    {
      Auth::guard('hr')->logout();
      return view('hr.unavailable.register',[
      ]);
    }
}
