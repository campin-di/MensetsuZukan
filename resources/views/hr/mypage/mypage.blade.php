@section('title', 'マイページ')
<link rel="stylesheet" href="{{ asset('css/st/mypage/mypage.css') }}">
@extends('layouts.hr.nofooter')
@section('content')

@include('components.parts.page_title', ['title'=>'マイページ'])

@include('components.parts.modal.confirm_request')

<div class="container">
  @include('components.parts.profile', ['imagePath' => $userData->image_path, 'userName' => '', 'nickName' => $userData->nickname, 'description' => $userData->company, 'introduction' => $userData->introduction])
  
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
            <span class="item_name">{{ $interviewReservation['nickname'] }}</span>
          </div>
          <div class="right_child item_date">
            {{ $interviewReservation['date'] }}：{{ $interviewReservation['time'] }}
          </div>
        </a>
      </li>
      @endforeach
    </ul>
  </div>

  <div class="container_pastVideo">
    <h2 class="container_schedule_title">過去の面接動画</h2>
  </div>
  
  @include('components.parts.pc_left_fixed',[
    'img' => 'img/interview-list.svg', 
    'route' => 'hr.interview.chat.list',
    'description' => 'メッセージ' 
  ])

  @include('components.parts.pc_right_fixed',[
    'img' => 'img/search-hr.svg', 
    'route' => 'hr.interview.request',
    'description' => '面接リクエストの確認' 
  ]) 
</div>
@endsection
