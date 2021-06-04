@extends('layouts.hr.common')
<link rel="stylesheet" href="{{ asset('css/st/mypage/mypage.css') }}">
@section('content')

@include('components.parts.page_title', ['title'=>'マイページ'])

<div class="container">
  @include('components.parts.profile', ['imagePath' => $userData->image_path, 'userName' => $userData->name, 'nickName' => '', 'description' => $userData->company, 'introduction' => $userData->introduction])

  <div class="container_profile_btn">
    <a href="{{ route('hr.mypage.detail') }}" class="mx-2 btn btn-primary container_profile_btn_profile">プロフィール詳細</a>
    <a href="{{ route('hr.mypage.basic.show') }}" class="mx-2 btn btn-primary container_profile_btn_info">基本情報の変更</a>
  </div>

  <div class="container_schedule">
    <h2 class="container_schedule_title">面接予定</h2>
    <ul class="container_schedule_list">
      @foreach($interviewReservationsCollection as $interviewReservation)
      <li>
        <a class="item" href="{{ route('hr.interview.detail', $interviewReservation['id']) }}">
          <div class="left_child">
            <img class="item_img" src="{{ asset($userData->image_path) }}" alt="">
            <span class="item_name">{{ $interviewReservation['name'] }}</span>
          </div>
          <div class="right_child item_date">
            {{ $interviewReservation['date'] }}
          </div>
        </a>
      </li>
      @endforeach
    </ul>
  </div>

  @include('components.parts.button.fixed_button',['routeName' => 'hr.interview.schedule.add', 'var'=>'', 'msg' => '', 'text' => '面接可能日を追加する'])

  <div class="container_pastVideo">
    <h2 class="container_pastVideo_title">過去の面接動画</h2>
  </div>

  @include('components.parts.video_content',[
    'videosCollection' => $pastVideosCollection,
    'routeName' => 'hr.watch',
    'upperRouteName' => 'hr.stpage',
    'underRouteName' => 'hr.hrpage'
  ])
</div>
@endsection
