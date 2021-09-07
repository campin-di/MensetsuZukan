@section('title', 'まずは面接予約をしよう！')
<link rel="stylesheet" href="{{ asset('css/st/unavailable/unavailable.css') }}">
@extends('layouts.st.common')
@section('content')
  <div class="block-wrapper">
    <div class="block-background"></div>
      <div class="block">
        <h1>LINE連携を行ってください！</h1>
        <div class="img">
          <img src="../img/unavailable/line-auth.svg" alt="LINEを連携しているイラスト">
        </div>
        <div class="description">
          面接図鑑ではLINE連携が<b>必須</b>となりました。<br>
          オファー通知などは公式LINEから行われます。<br>
          「LINE連携」よりLINEと連携してください。<br>
        </div>
        @include('components.parts.button.line_button', ['text'=>'LINE連携', 'routeName'=>'social_line.redirect', 'var'=>'line'])
      </div>
  </div>
@endsection
