<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;

use Auth;
use App\Models\Video;
use App\Models\Question;
use App\Models\InterviewRequest;

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

      $videos = Video::inRandomOrder()->where('type', config('const.STHR.HR'))->whereHas('User', function($q){
        $q->whereNotIn('graduate_year', ['2022']);
      })->get();

      $videosCollection = VideoDisplayClass::VideoDisplay($videos);
      $isRequest = InterviewRequest::where('hr_id', Auth::guard('hr')->id())->where('status', 0)->get()->count();

      return view('hr.home',compact('questions', 'videosCollection', 'isRequest'));
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
