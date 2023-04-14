@section('title', 'オファーを送るには？')
<link rel="stylesheet" href="{{ asset('css/st/unavailable/unavailable.css') }}">
@extends('layouts.hr.common')
@section('content')
  <div class="block-wrapper">
    <div class="block-background"></div>
      <div class="block">
        <h1>オファーを送るには？</h1>
        <div class="img">
          <img src="../../img/unavailable/unavailable-contributor.svg" alt="面接官を探しているイラスト">
          <a href="https://storyset.com/work" style="color: #EEE;font-size: 10px;">Work illustrations by Storyset</a>        
        </div>
        <div class="description">
          面接を行っていただくことで、<br>
          オファーの送信が可能となります。<br>
          下記ボタンよりスケジュールを登録し、<br>
          学生からの面接依頼をお待ちください。<br>
        </div>
        <a href="{{ route('hr.interview.schedule.add') }}">
          <div class="button">
            <span>スケジュール登録</span>
          </div>
        </a>
      </div>
  </div>
@endsection
