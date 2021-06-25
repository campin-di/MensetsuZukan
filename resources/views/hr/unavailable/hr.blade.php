@section('title', 'オファーを送るには？')
<link rel="stylesheet" href="{{ asset('css/hr/unavailable/unavailable.css') }}">
@extends('layouts.hr.common')
@section('content')
  <div class="block-wrapper">
    <div class="block-background"></div>
      <div class="block">
        <h1>オファーを送るには？</h1>
        <div class="img">
          <img src="../../img/top/features-content-illustration-1.png" alt="仮置き">
        </div>
        <div class="description">
          面接を行っていただくことで、<br>
          全てのサービス利用学生に対して<br>
          オファーの送信が可能となります。<br><br>
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
