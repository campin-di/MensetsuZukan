@extends('layouts.st.common')
<link rel="stylesheet" href="{{ asset('css/st/mypage/mypage.css') }}">
@section('content')
  @include('components.parts.page_title', ['title'=>'マイページ'])

  <div class="container">
    @include('components.parts.profile', ['imagePath' => $userDataArray['imagePath'], 'userName' => $userDataArray['name'], 'nickName' => '', 'description' => $userDataArray['company'], 'introduction' => $userDataArray['introduction'] ])
    @include('components.parts.button.transition_button', ['routeName' => 'hrpage.detail', 'var' => $userDataArray['id'], 'text' => '詳しいプロフィール'])
    @include('components.parts.button.fixed_button',['routeName' => 'interview.schedule', 'var' => $userDataArray['id'], 'msg' => '', 'text' =>  $userDataArray['name'] .'さんとの面接を予約する。'])
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
