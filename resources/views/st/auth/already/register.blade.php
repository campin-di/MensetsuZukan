@section('title', 'まずは面接予約をしよう！')
<link rel="stylesheet" href="{{ asset('css/st/unavailable/unavailable.css') }}">
@extends('layouts.st.common')
@section('content')
  <div class="block-wrapper">
    <div class="block-background"></div>
      <div class="block">
        <h1>LINEアカウントと連携してください</h1>
        <div class="img">
          <img src="../img/unavailable/unavailable-contributor.svg" alt="面接官を探しているイラスト">
          <a href="https://storyset.com/work" style="color: #EEE;font-size: 10px;">Work illustrations by Storyset</a>        
        </div>
        <div class="description" style="font-size:14px">
          面接図鑑ではLINE連携が必須となりました。<br>
          オファー通知などは公式LINEから行われます。<br>
          「LINEと連携」よりLINEアカウントを登録してください。<br>
        </div>
        @include('components.parts.button.line_button', ['text'=>'LINEと連携', 'routeName'=>'social_line.redirect', 'var'=>'line'])
      </div>
  </div>
@endsection
