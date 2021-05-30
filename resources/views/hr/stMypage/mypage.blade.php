@extends('layouts.hr.common')
@section('content')
<link rel="stylesheet" href="{{ asset('css/hr/stMypage/mypage.css') }}">

<div class="container">
  <h1 class="container_title">マイページ</h1>

  <div class="container_profile">
    <img class="container_profile_img" src="{{ asset('img/kokyo.png') }}" alt="">
    <p class="container_profile_name">
      {{ $stName }}
    </p>
    <p class="container_profile_company">
      地方国立大/23卒
    </p>
    <p class="container_profile_detail">
      ここに自己紹介を記入します<br>
      ここに自己紹介を記入します
    </p>
    <div class="container_profile_btn">
      <a href="{{ route('hr.stpage.detail', $stId) }}" class="mx-2 btn btn-primary container_profile_btn_profile">詳しいプロフィール</a>
      <a href="{{ route('hr.offer.form', $stId) }}" class="mx-2 btn btn-primary container_profile_btn_offer">オファーする</a>
    </div>
  </div>

  <h2>過去の面接</h2>
  @foreach($pastVideosCollection as $video)
    <a href="{{ route('hr.watch', $video['id'])}}">
      <div>
        <img src="{{ $video['thumbnail_path'] }}" width="360" height="240">
      </div>
      {{ $video['title'] }}<br>

      <div class="d-flex justify-content-start">
        <div class="mx-2 btn btn-primary">{{ $video['question']}}</div>
        @foreach($video['otherQuestionsArray'] as $otherQuestion)
          <div class="mx-2 btn btn-secondary">
            {{ $otherQuestion['question']->name }}
          </div>
        @endforeach
      </div>

      {{ $video['score']}}点<br>
      {{ $video['views'] }}回視聴<br>
      いいね：{{ $video['good'] }}<br>
      {{ $video['review'] }}<br>
      {{ $video['diffDate'] }}<br>
    </a>
  @endforeach
</div>
@endsection
