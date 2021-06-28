@section('title', $userDataArray['nickname'].'さんのマイページ')
<link rel="stylesheet" href="{{ asset('css/st/mypage/mypage.css') }}">
@extends('layouts.st.nofooter')
@section('content')
  @include('components.parts.page_title', ['title'=>'マイページ'])

  <div class="container">
    @include('components.parts.profile', ['imagePath' => $userDataArray['imagePath'], 'userName' => '', 'nickName' => $userDataArray['nickname'], 'description' => $userDataArray['industry'], 'introduction' => $userDataArray['introduction'] ])
    <div class="container_profile_btn">
      <a href="{{ route('hrpage.detail', $userDataArray['id']) }}" class="mx-2 btn btn-primary container_profile_btn_profile">詳しいプロフィール</a>
      <a href="{{ route('interview.schedule', $userDataArray['id']) }}" class="mx-2 btn btn-primary container_profile_btn_offer">面接の予約</a>
    </div>
    @include('components.parts.button.fixed_button',['routeName' => 'interview.schedule', 'var' => $userDataArray['id'], 'msg' => '', 'text' =>  '面接の予約'])
  </div>

  <div class="container_pastVideo">
    <h2 class="container_schedule_title">過去の面接動画</h2>
  </div>
  @include('components.parts.video_content',[
    'videosCollection' => $pastVideosCollection,
    'routeName'=>'watch',
    'upperRouteName' => 'stpage',
    'underRouteName' => 'hrpage'
  ])
@endsection
