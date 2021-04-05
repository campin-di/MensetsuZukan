<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;

use App\Models\Video;

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
      $videos = Video::take(5)->get();

      $videosCollection = VideoDisplayClass::VideoDisplay($videos);

      return view('hr.home',[
        'videosCollection' => $videosCollection,
      ]);
    }
}
