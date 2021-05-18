@extends('layouts.hr.common')
@section('content')
<link rel="stylesheet" href="{{ asset('css/hr/hrMypage/their_page.css') }}">

<div class="container">
  <h1 class="container_title">マイページ</h1>
  <div class="container_profile">
    <img class="container_profile_img" src="{{ asset('img/kokyo.png') }}" alt="">
    <p class="container_profile_name">
      {{ $userDataArray['name'] }}
    </p>
    <p class="container_profile_category">
      {{ $userDataArray['company'] }}
    </p>
    <p class="container_profile_detail">
      地方国立理系です！<br>
      長期インターンや留学の経験がなく、アルバイト経験のみで頑張っています！！
    </p>
    <div class="container_profile_btn">
      <a href="{{ route('hr.hr_theirPage.detail', $userDataArray['id']) }}" class="mx-2 btn btn-primary container_profile_btn_profile">プロフィール詳細</a>
    </div>
  </div>

  <div class="container_pastVideo">
    <h2 class="container_pastVideo_title">過去の面接動画</h2>
  </div>
  @foreach($pastVideosCollection as $video)
    <a href="{{ route('watch', $video['id'])}}">
      <iframe width="100%" height="315" src="{{ $video['url'] }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><br>
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
