@section('title', $userData->nickname.'さんのマイページ')
<link rel="stylesheet" href="{{ asset('css/st/mypage/mypage.css') }}">
@extends('layouts.hr.common')
@section('content')
  @include('components.parts.page_title', ['title'=>'マイページ'])

  <div class="container">
    @include('components.parts.profile', ['imagePath' => $userData->image_path, 'userName' => '', 'nickName' => $userData->nickname, 'description' => $userData->industry, 'introduction' => $userData->introduction])
    @include('components.parts.button.transition_button', ['routeName' => 'hr.hrpage.detail', 'var' => $userData->id, 'text' => '詳しいプロフィール'])
  </div>

  <div class="container_pastVideo">
    <h2 class="container_schedule_title">過去の面接動画</h2>
  </div>
  @include('components.parts.video_content',[
    'videosCollection' => $pastVideosCollection,
    'routeName'=>'hr.watch',
    'upperRouteName' => 'hr.stpage',
    'underRouteName' => 'hr.hrpage'
  ])
@endsection
