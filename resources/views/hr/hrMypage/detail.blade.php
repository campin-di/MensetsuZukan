@extends('layouts.hr.common')
@section('content')
<link rel="stylesheet" href="{{ asset('css/hr/hrMypage/detail.css') }}">

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
      <label class="acd-label" for="acd-check1">会社紹介<a href="{{ route('hr.mypage.detail.show') }}">（編集）</a></label>
      <div class="acd-content">
        <div>{{--会社ページに遷移させる予定--}}
        {{ $profileDetailArray['company'] }}</div>
      </div>
    </div>
    <div class="item">
      <input id="acd-check2" class="acd-check" type="checkbox">
      <label class="acd-label" for="acd-check2">業界<a href="{{ route('hr.mypage.detail.show') }}">（編集）</a></label>
      <div class="acd-content">
        <p>{{ $profileDetailArray['industry'] }}</p>
      </div>
    </div>
    <div class="item">
      <input id="acd-check3" class="acd-check" type="checkbox">
      <label class="acd-label" for="acd-check3">企業タイプ<a href="{{ route('hr.mypage.detail.show') }}">（編集）</a></label>
      <div class="acd-content">
        <p>{{ $profileDetailArray['companyType'] }}</p>
      </div>
    </div>
    <div class="item">
      <input id="acd-check4" class="acd-check" type="checkbox">
      <label class="acd-label" for="acd-check4">どんな面接ができる？<a href="{{ route('hr.mypage.detail.show') }}">（編集）</a></label>
      <div class="acd-content">
        <p>{{ $profileDetailArray['pr'] }}</p>
      </div>
    </div>
  </div>


</div>
@endsection
