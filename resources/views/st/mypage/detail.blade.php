@extends('layouts.st.common')
@section('content')
<link rel="stylesheet" href="{{ asset('css/st/detail.css') }}">

<div class="container">
  <h1 class="container_title">プロフィール詳細</h1>

  <div class="container_detail">
    <div class="item">
      <input id="acd-check1" class="acd-check" type="checkbox">
      <label class="acd-label" for="acd-check1">強み<a href="{{ route('mypage.detail.show') }}">（編集）</a></label>
      <div class="acd-content">
        <p>{{ $profileDetailArray['strengths'] }}</p>
      </div>
    </div>
    <div class="item">
      <input id="acd-check2" class="acd-check" type="checkbox">
      <label class="acd-label" for="acd-check2">ガクチカ<a href="{{ route('mypage.detail.show') }}">（編集）</a></label>
      <div class="acd-content">
        <p>{{ $profileDetailArray['gakuchika'] }}</p>
      </div>
    </div>
    <div class="item">
      <input id="acd-check3" class="acd-check" type="checkbox">
      <label class="acd-label" for="acd-check3">私の性格<a href="{{ route('mypage.detail.show') }}">（編集）</a></label>
      <div class="acd-content">
        <p>{{ $profileDetailArray['personality'] }}</p>
      </div>
    </div>
    <div class="item">
      <input id="acd-check4" class="acd-check" type="checkbox">
      <label class="acd-label" for="acd-check4">クリックで開く<a href="{{ route('mypage.detail.show') }}">（編集）</a></label>
      <div class="acd-content">
        <p>hello.world!</p>
      </div>
    </div>
    <div class="item">
      <input id="acd-check5" class="acd-check" type="checkbox">
      <label class="acd-label" for="acd-check5">クリックで開く<a href="{{ route('mypage.detail.show') }}">（編集）</a></label>
      <div class="acd-content">
        <p>hello.world!</p>
      </div>
    </div>
  </div>


</div>
@endsection
