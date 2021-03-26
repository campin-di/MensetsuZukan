<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class MypageController extends Controller
{
  public function index()
  {
    $userId = Auth::user()->id;

    $mypageCollection = concat([]);

    return view('mypage/mypage',[

    ]);
  }
}
