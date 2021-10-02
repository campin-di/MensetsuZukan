@section('title', 'マイページ')
<link rel="stylesheet" href="{{ asset('css/st/mypage/mypage.css') }}">
@extends('layouts.st.nofooter')
@section('content')

@include('components.parts.page_title', ['title'=>'マイページ'])

<div class="container">
  @include('components.parts.profile',[
    'imagePath' => $userDataArray['imagePath'],
    'userName' => '',
    'nickName' => $userDataArray['nickname'],
    'description' => $userDataArray['graduate_year'] .'年卒 / '. $userDataArray['industry']. ' 志望',
    'introduction' => $userDataArray['introduction']
  ])

  <div class="container_profile_btn">
    <a href="{{ route('mypage.detail') }}" class="mx-2 btn btn-primary container_profile_btn_profile">プロフィール詳細</a>
    <a href="{{ route('mypage.basic.show') }}" class="mx-2 btn btn-primary container_profile_btn_info">基本情報の変更</a>
  </div>
  @if($userDataArray['plan'] == "admin")
    <div class="container_profile_btn" style="margin-top:10px;">
      <a href="{{ route('admin') }}" class="mx-2 btn btn-secondary container_profile_btn_info">管理画面</a>
    </div>
  @endif

  <div class="container_schedule">
    <h2 class="container_schedule_title">面接予定</h2>
    <ul class="container_schedule_list">
      @if($interviewReservationsCollection->count() != 0)
        @foreach($interviewReservationsCollection as $interviewReservation)
          <li>
            <a class="item" href="{{ route('interview.detail', $interviewReservation['id']) }}">
              <div class="left_child">
                <img class="item_img" src="{{ asset($interviewReservation['imagePath']) }}" alt="">
                <span class="item_name">{{ $interviewReservation['nickname'] }}</span>
              </div>
              <div class="right_child item_date">
                {{ $interviewReservation['date'] }}：{{ $interviewReservation['time'] }}
              </div>
            </a>
          </li>
        @endforeach
      @else
        <div class="none-reservation-wrapper">
          <p style="width: 90%; margin: auto;">
            まだ模擬面接の予定がありません...。
            <br><br>
            画面下の<b>
              <span class="pc">「面接練習にチャレンジ」</span>
              <span class="sp" >「面接練習」</span>
            </b>から、面接申し込みをしてみましょう！
          </p>
        </div>
      @endif
    </ul>
  </div>

  @include('components.parts.pc_left_fixed',[
    'img' => 'img/interview-list.svg', 
    'route' => 'interview.chat.list',
    'description' => 'メッセージ' 
  ])


  @include('components.parts.pc_right_fixed',[
    'img' => 'img/search-hr.svg', 
    'route' => 'interview.search',
    'description' => '面接練習にチャレンジ！' 
  ]) 

  <div class="container_pastVideo">
    <h2 class="container_schedule_title">過去の面接動画</h2>
  </div>
  @include('components.parts.video_content',[
    'videosCollection' => $pastVideosCollection,
    'routeName' => 'watch',
    'upperRouteName' => 'stpage',
    'underRouteName' => 'hrpage'
  ])
</div>
@endsection
