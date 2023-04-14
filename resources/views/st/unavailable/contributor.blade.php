@section('title', 'まずは面接予約をしてください！')
<link rel="stylesheet" href="{{ asset('css/st/unavailable/unavailable.css') }}">
@extends('layouts.st.common')
@section('content')
  <div class="block-wrapper">
    <div class="block-background"></div>
      <div class="block">
        <h1>面接予約をしてください！</h1>
        <div class="img">
          <img src="{{ asset('img/unavailable/unavailable-contributor.svg') }}" alt="面接官を探しているイラスト">
          <a href="https://storyset.com/work" style="color: #EEE;font-size: 10px;">Work illustrations by Storyset</a>        
        </div>
        <div class="description">
          面接を行ってください！<br>
          模擬面接を行っていただいたあと、<br>
          全国の就活生の面接を全てご覧いただけます！<br>
        </div>
        <a href="{{ route('interview.search') }}">
          <div class="button">
            <span>面接官を探す</span>
          </div>
        </a>
      </div>
  </div>
@endsection
