<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use App\Common\DiffDateClass;

use App\Models\User;
use App\Models\HrUser;
use App\Models\Video;

class HomeController extends Controller
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
      $videos_collection = collect([]);

      $videos = Video::take(5)->get();

      foreach ($videos as $video) {
        $diffDate = DiffDateClass::diffDate($video->created_at);

        $videos_collection = $videos_collection->concat([
          [
            'url' => $video->url,
            'title' => $video->title,
            'score' => $video->score,
            'views' => $video->views,
            'good'  => $video->good,
            'review'=> $video->review,
            'diffDate' => $diffDate,
          ],
        ]);

      }
      //var_dump($videos_collection);

      $test = 1;

      return view('home',[
        'videos_collection' => $videos_collection,
        'test' => $test,
      ]);
    }
}
