@extends('layouts.st.common')
@section('content')
<link rel="stylesheet" href="{{ asset('css/st/mypage.css') }}">

<div class="container">
  <h1 class="container_title">マイページ</h1>

  @if($userDataArray['plan'] == "admin")
    <a class="nav-link" href="{{ route('upload') }}">アップロード</a>
  @endif

  <div class="container_profile">
    <img class="container_profile_img" src="{{ asset('img/kokyo.png') }}" alt="">
    <p class="container_profile_name">
      {{ $userDataArray['name'] }}
      {{ $userDataArray['nickname'] }}
    </p>
    <p class="container_profile_category">
      地方国公立/IT業界志望/23卒
    </p>
    <p class="container_profile_detail">
      地方国立理系です！<br>
      長期インターンや留学の経験がなく、アルバイト経験のみで頑張っています！！
    </p>
    <div class="container_profile_btn">
      <a href="{{ route('mypage.detail') }}" class="mx-2 btn btn-primary container_profile_btn_profile">プロフィール詳細</a>
      <a href="{{ route('mypage.basic.show') }}" class="mx-2 btn btn-primary container_profile_btn_info">基本情報の変更</a>
    </div>
  </div>

  <div class="container_schedule">
    <h2 class="container_schedule_title">面接予定</h2>
    <ul class="container_schedule_list">
      @foreach($interviewReservationsCollection as $interviewReservation)
      <li>
        <a class="item" href="{{ route('interview.detail', $interviewReservation['id']) }}">
          <img class="item_img" src="{{ asset('img/kokyo.png') }}" alt="">
          <p class="item_name">{{ $interviewReservation['name'] }}</p>
          <p class="item_date">{{ $interviewReservation['date'] }}</p>
      </a>
      </li>
      @endforeach
    </ul>
    <a class="container_schedule_reservation btn btn-primary" href="{{ route('interview.search') }}">面接を予約する</a>
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
