@extends('layouts.hr.common')
@section('content')
<link rel="stylesheet" href="{{ asset('css/hr/hrMypage/mypage.css') }}">

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
     Somy 株式会社 の人事部 吉田裕哉です。<br> 大手からベンチャーまで幅広い人事経験があります。<br> 素敵な出会いを楽しみにしております！
    </p>
    <div class="container_profile_btn">
      <a href="{{ route('hr.mypage.detail') }}" class="mx-2 btn btn-primary container_profile_btn_profile">プロフィール詳細</a>
      <a href="{{ route('hr.mypage.basic.show') }}" class="mx-2 btn btn-primary container_profile_btn_info">基本情報の変更</a>
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
    <a class="container_schedule_reservation btn btn-primary" href="{{ route('hr.interview.schedule.add') }}">面接可能日程を追加する。</a>
  </div>


  <div class="container_pastVideo">
    <h2 class="container_pastVideo_title">過去の面接動画</h2>
  </div>
  @foreach($pastVideosCollection as $video)
    <a href="{{ route('hr.watch', $video['id'])}}">
      <div>
        <img src="{{ $video['thumbnailsUrl'] }}" width="360" height="240">
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
