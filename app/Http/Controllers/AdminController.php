<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

use App\Common\CutStringClass;

class AdminController extends Controller
{
  function index(){
    $videos = Video::latest()->with(['hrUser','user'])->get();

    $stVideoCollection = collect();
    $hrVideoCollection = collect();
    foreach ($videos as $video) {
      if($video->type == config('const.STHR.ST')){
        $stVideoCollection = $stVideoCollection->concat([
          [
            'id' => $video->id,
            'title' => CutStringClass::CutString($video->title, 20),
            'vimeoUrl' => $video->vimeo_src,
            'vimeoId' => $video->vimeo_id,
            'stName' => $video->user->name,
            'stNickname' => $video->user->nickname,
            'hrName' => $video->hrUser->name,
            'company' => $video->hrUser->company,
            'score' => $video->basic_score + $video->expression_score + $video->logical_score + $video->vitality_score + $video->creative_score,
            'review' => CutStringClass::CutString($video->review, 7),
            'type' => '学生',
            'upload' => $video->created_at,
            'thumbnail_name' => $video->thumbnail_name,
          ],
        ]);
      } else {
        $hrVideoCollection = $hrVideoCollection->concat([
          [
            'id' => $video->id,
            'title' => CutStringClass::CutString($video->title, 20),
            'vimeoUrl' => $video->vimeo_src,
            'vimeoId' => $video->vimeo_id,
            'stName' => $video->user->name,
            'stNickname' => $video->user->nickname,
            'hrName' => $video->hrUser->name,
            'company' => $video->hrUser->company,
            'score' => $video->basic_score + $video->expression_score + $video->logical_score + $video->vitality_score + $video->creative_score,
            'review' => CutStringClass::CutString($video->review, 7),
            'type' => '人事',
            'upload' => $video->created_at,
            'thumbnail_name' => $video->thumbnail_name,
          ],
        ]);
      }
    }

    return view("admin.admin", compact('stVideoCollection', 'hrVideoCollection'));
  }
}
