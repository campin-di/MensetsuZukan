<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Common\RedirectClass;
use DateTime;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Log;

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

      // :point_down: アクセストークン
      $this->access_token = env('LINE_ACCESS_TOKEN');
      // :point_down: チャンネルシークレット
      $this->channel_secret = env('LINE_CHANNEL_SECRET');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $user = Auth::user();
    //=== LINEアカウントが未登録の人はリダイレクト ===============
      if(is_null($user->line_id)){
        return view('st.auth.already.register',[]);
      }
    //======================================================
    //=====もし視聴不可状態のときはリダイレクト===================================
    if($redirect = RedirectClass::stRedirect()){
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

    $practiceFlag = FALSE;
    if(!session()->has('practice')){
      $practiceFlag = TRUE;
      session(['practice' => true]);
    } 

    $videos = Video::inRandomOrder()->where('type', config('const.STHR.ST'))->get();
    $videosCollection = VideoDisplayClass::VideoDisplay($videos);

    return view('st.home',compact('questions', 'practiceFlag', 'videosCollection'));
  }

  public function topHr()
  {

    return view('top_hr',[
    ]);
  }

  public function preContributor()
  {

    return view('st.unavailable.contributor',[
    ]);
  }

  public function preAudience()
  {

    return view('st.unavailable.audience',[
    ]);
  }

  public function preRegister()
  {
    Auth::logout();
    return view('st.unavailable.register',[
    ]);
  }

  public function redirectToProvider(Request $request) {
      $provider = $request->provider;
      return Socialite::driver($provider)->redirect();

  }

}
