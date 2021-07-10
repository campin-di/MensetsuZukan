@section('title', 'まずは面接予約をしよう！')
<link rel="stylesheet" href="{{ asset('css/st/unavailable/unavailable.css') }}">
@extends('layouts.st.common')
@section('content')
  <div class="block-wrapper">
    <div class="block-background"></div>
      <div class="block">
        <h1>面接予約をしよう！</h1>
        <div class="img">
          <img src="../img/unavailable/unavailable-contributor.svg" alt="面接官を探しているイラスト">
          <a href="https://storyset.com/work" style="color: #EEE;font-size: 10px;">Work illustrations by Storyset</a>        
        </div>
        <div class="description">
          面接官を探しましょう！<br>
          面接後、動画が公開されると、<br>
          他の就活生の面接が見放題になります！<br>
        </div>
        <a href="{{ route('interview.search') }}">
          <div class="button">
            <span>面接官を探す</span>
          </div>
        </a>
      </div>
  </div>
@endsection
