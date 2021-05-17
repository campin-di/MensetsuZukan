@extends('layouts.st.common')
@section('content')
<link rel="stylesheet" href="{{ asset('css/st/hrMypage/mypage.css') }}">

<div class="container">
  <h1 class="container_title">マイページ</h1>

  <div class="container_profile">
    <img class="container_profile_img" src="{{ asset('img/kokyo.png') }}" alt="">
    <p class="container_profile_name">
      {{ $userDataArray['name'] }}
    </p>
    <p class="container_profile_company">
      {{ $userDataArray['company'] }}
    </p>
    <p class="container_profile_detail">
      Somy株式会社の人事部 吉田裕哉です。<br>
      大手からベンチャーまで幅広い人事経験があります。<br>
      素敵な出会いを楽しみにしております！
    </p>
    <div class="container_profile_btn">
      <a href="{{ route('hr_mypage.detail', $userDataArray['id']) }}" class="mx-2 btn btn-primary container_profile_btn_profile">詳しいプロフィールを見る</a>
    </div>
  </div>


  <a href="{{ route('interview.schedule', $userDataArray['id']) }}">{{ $userDataArray['name'] }}と面接を予約する。</a>

  <h2>過去の面接</h2>
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
