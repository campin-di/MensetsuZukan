<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\Video;

class St_PublicController extends Controller
{
    public function index($video_id)
    {  
        $selectedVideo = Video::find($video_id);
        $interviewId = $selectedVideo->interview_id;

        if($selectedVideo->st_id != Auth::user()->id){
            return redirect()->route('watch', $video_id);
        }

        $videos = Video::where('interview_id', $interviewId)->get();

        foreach($videos as $video){
            switch ($video->type){
                case config('const.STHR.ST'):
                    $video->type = config('const.STHR.ST_N');
                    break;
                case config('const.STHR.ST_N'):
                    $video->type = config('const.STHR.ST');
                    break;
                default:
                    break;
            }
            $video->save();
        }    
      return redirect()->route('watch', $video_id);
    }
}
