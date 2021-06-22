@extends('layouts.hr.common')
<link rel="stylesheet" href="{{ asset('css/st/mypage/mypage.css') }}">
@section('content')
  @include('components.parts.page_title', ['title'=>'マイページ'])

  <div class="container">
    @include('components.parts.profile', ['imagePath' => $userData->image_path, 'userName' => $userData->name, 'nickName' => '', 'description' => $userData->graduate_year .'年卒 / '. $userData->industry. '業界 志望', 'introduction' => $userData->introduction ])

    <div class="container_profile_btn">
      <a href="{{ route('hr.stpage.detail', $userData->id) }}" class="mx-2 btn btn-primary container_profile_btn_profile">詳しいプロフィール</a>
      <a href="{{ route('hr.offer.form', $userData->id) }}" class="mx-2 btn btn-primary container_profile_btn_offer">オファーする</a>
    </div>
  </div>

  <div class="container_pastVideo">
    <h2 class="container_schedule_title">過去の面接動画</h2>
  </div>

  @include('components.parts.video_content',['videosCollection' => $pastVideosCollection, 'routeName'=>'hr.watch', 'upperRouteName' => 'hr.stpage', 'underRouteName' => 'hr.hrpage'])
@endsection
