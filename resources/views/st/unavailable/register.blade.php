@section('title', '本会員登録を行ってください。')
<link rel="stylesheet" href="{{ asset('css/st/unavailable/unavailable.css') }}">
@extends('layouts.st.common')
@section('content')
  <div class="block-wrapper">
    <div class="block-background"></div>
      <div class="block">
        <h1>本会員登録が完了していません。</h1>
        <div class="img">
          <img src="../img/unavailable/unavailable-register.svg" alt="ログインを試みるイラスト">
          <a href="https://storyset.com/work" style="color: #EEE;font-size: 10px;">Work illustrations by Storyset</a>        
        </div>
        <div class="description">
          仮会員登録時に届いたメールから本会員登録を行ってください。<br><br>
          ＜メールを紛失した場合は？＞<br>
          仮会員登録より24時間以上経ってから、再度会員登録を行ってください。
        </div>
        <a href="{{ url('/') }}">
          <div class="button">
            <span>トップページに戻る</span>
          </div>
        </a>
      </div>
  </div>
@endsection
