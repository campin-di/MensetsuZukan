@section('title', $userDataArray['nickname'].'さんのマイページ')
<link rel="stylesheet" href="{{ asset('css/st/mypage/mypage.css') }}">
@extends('layouts.st.nofooter')
@section('content')
  @include('components.parts.page_title', ['title'=>'マイページ'])

  <div class="container">
    @include('components.parts.profile', ['imagePath' => $userDataArray['imagePath'], 'userName' => '', 'nickName' => $userDataArray['nickname'], 'description' => $userDataArray['industry'], 'introduction' => $userDataArray['introduction'] ])
    @include('components.parts.button.transition_button', ['routeName' => 'hrpage.detail', 'var' => $userDataArray['id'], 'text' => '詳しいプロフィール'])
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
