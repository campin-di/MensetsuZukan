@extends('layouts.hr.reverse')
<link href="{{ asset('/css/st/auth/main/registerd.css') }}" rel="stylesheet">
@section('content')
<div class="top-content-wrapper">
  <div class="top-content">
    <h1>本会員登録完了</h1>
  </div>
</div>

<div class="container form-wrapper">
  <div class="title">面接図鑑をご利用ください。</div>

  <div class="upper-button">
    <a href="{{ url('/') }}" class="sg-btn">トップページに戻る</a>
  </div>
  <div class="under-button">
    <a href="{{ route('hr.login') }}" class="sg-btn">ログイン</a>
  </div>
</div>
@endsection
