@extends('layouts.st.common')
@section('content')
<link rel="stylesheet" href="{{ asset('css/st/mypage/mypage.css') }}">

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
  </div>

  @include('components.button.fixed_button',['routeName' => 'interview.search', 'msg' => '', 'text' => '面接を予約する'])

  <div class="container_pastVideo">
    <h2 class="container_pastVideo_title">過去の面接動画</h2>
  </div>

  @include('components.video_content',['videosCollection' => $pastVideosCollection])
</div>
@endsection
