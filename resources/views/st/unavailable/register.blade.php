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
        </div>
        <div class="description">
          仮会員登録時に届いたLINEから本会員登録を行ってください。<br><br>
          届かなかった場合は、下記メールアドレスまでご連絡ください。<br><br>
          mensetsu-zukan@pampam.co.jp
        </div>
        <a href="{{ url('/') }}">
          <div class="button">
            <span>トップページに戻る</span>
          </div>
        </a>
      </div>
  </div>
@endsection
