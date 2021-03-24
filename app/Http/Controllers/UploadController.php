<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Video;

use Validator;

class UploadController extends Controller
{
  public function index()
  {
      return view('\upload\upload');
  }

  public function register(Request $request)
  {
    $video = new Video;
    $video->link = $request->youtube_link;
    $video->title = $request->title;
    $video->score = $request->score;
    $video->review = $request->review;
    $video->views = $request->views;
    $video->st_id = User::where('', $request->new_lib_faculty)->first()
    $video->save();

    return view('\upload\registered');
  }
}
