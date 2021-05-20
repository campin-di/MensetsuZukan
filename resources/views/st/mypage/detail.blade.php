@extends('layouts.st.common')
<link rel="stylesheet" href="{{ asset('css/st/mypage/detail.css') }}">
@section('content')

<div class="container">
  <h1 class="container_title">プロフィール詳細</h1>

  <div class="container_profile">
    <img class="container_profile_img" src="{{ asset('img/kokyo.png') }}" alt="">
    <p class="container_profile_name">
      kokyo
    </p>
    <p class="container_profile_category">
      地方国公立/IT業界志望/23卒
    </p>
    <p class="container_profile_detail">
      地方国立理系です！<br>
      長期インターンや留学の経験がなく、アルバイト経験のみで頑張っています！！
    </p>
  </div>

  <div class="container_detail">
    <div class="item">
    <input id="acd-check1" class="acd-check" type="checkbox" />
      <label class="acd-label" for="acd-check1">強み<a href="{{ route('mypage.detail.show') }}">（編集）</a></label>
      <div class="acd-content">
        <div>{{ $profileDetailArray['strengths'] }}</div>
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
        <p>杉山誇京杉山誇京杉山誇京杉山誇京杉山誇京杉山誇京杉山誇京杉山誇京杉山誇京杉山誇京杉山誇京杉山誇京杉山誇京杉山誇京杉山誇京杉山誇京杉山誇京杉山誇京杉山誇京杉山誇京杉山誇京杉山誇京杉山誇京杉山誇京</p>
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
