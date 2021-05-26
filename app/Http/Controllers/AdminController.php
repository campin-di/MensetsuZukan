<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

use App\Common\CutStringClass;

class AdminController extends Controller
{
  function index(){

    $videos = Video::latest()->with(['hrUser','user'])->get();
/*
    foreach ($videos as $value) {
      if(!is_null($value->hrUser)){
        echo $value->hrUser;
      } else {
        echo "222";
      }
    }
*/
    //$videos = Interview::where('st_id', $userId)->with('hr_user')->select('id', 'hr_id', 'date', 'url')->get();


    $videoCollection = collect();
    foreach ($videos as $video) {
      if($video->type == 0){
        $type = '学生';
      } else {
        $type = '人事';
      }

      $videoCollection = $videoCollection->concat([
        [
          'id' => $video->id,
          'title' => CutStringClass::CutString($video->title, 20),
          'vimeoUrl' => $video->vimeo_src,
          'vimeoId' => $video->vimeo_id,
          'stName' => $video->user->name,
          'stNickname' => $video->user->nickname,
          'hrName' => $video->hrUser->name,
          'company' => $video->hrUser->company,
          'score' => $video->score,
          'review' => CutStringClass::CutString($video->review, 7),
          'type' => $type,
          'upload' => $video->created_at,
          'thumbnail_name' => $video->thumbnail_name,
        ],
      ]);
    }

    return view("admin.admin", compact('videoCollection'));
  }
}
