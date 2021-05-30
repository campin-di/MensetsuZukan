@extends('layouts.st.common')
@section('content')
<link rel="stylesheet" href="{{ asset('css/st/mypage/mypage.css') }}">

@include('components.parts.page_title', ['title'=>'マイページ'])

<div class="container">

  @if($userDataArray['plan'] == "admin")
    <a class="nav-link" href="{{ route('upload') }}">アップロード</a>
  @endif

  @include('components.parts.profile',['imagePath' => $userDataArray['imagePath'], 'isHr' => '', 'userName' => $userDataArray['name'], 'nickName' => $userDataArray['nickname'], 'description' => '地方〇〇/〇〇業界志望/〇〇卒', 'introduction' => '地方国立理系です！長期インターンや留学の経験がなく、アルバイト経験のみで頑張っています！' ])

  <div class="container_profile_btn">
    <a href="{{ route('mypage.detail') }}" class="mx-2 btn btn-primary container_profile_btn_profile">プロフィール詳細</a>
    <a href="{{ route('mypage.basic.show') }}" class="mx-2 btn btn-primary container_profile_btn_info">基本情報の変更</a>
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

  @include('components.parts.button.fixed_button',['routeName' => 'interview.search', 'isHr' => '', 'ver'=>'', 'msg' => '', 'text' => '面接を予約する'])

  <div class="container_pastVideo">
    <h2 class="container_pastVideo_title">過去の面接動画</h2>
  </div>

  @include('components.parts.video_content',['videosCollection' => $pastVideosCollection, 'isHr' => ''])
</div>
@endsection
