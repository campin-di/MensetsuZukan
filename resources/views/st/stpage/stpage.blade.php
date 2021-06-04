@extends('layouts.st.common')
@section('content')
<link rel="stylesheet" href="{{ asset('css/st/mypage/mypage.css') }}">

@include('components.parts.page_title', ['title'=>'マイページ'])

<div class="container">
  @include('components.parts.profile',['imagePath' => $userDataArray['imagePath'], 'isHr' => '', 'userName' => '', 'nickName' => $userDataArray['nickname'], 'description' => $userDataArray['graduate_year'] .'年卒/'. $userDataArray['industry'], 'introduction' => $userDataArray['introduction'] ])
  @include('components.parts.button.transition_button', ['routeName' => 'stpage.detail', 'var' => $userDataArray['stId'], 'text' => '詳しいプロフィール'])

  <div class="container_pastVideo">
    <h2 class="container_schedule_title">過去の面接動画</h2>
  </div>

  @include('components.parts.video_content',['videosCollection' => $pastVideosCollection, 'routeName' => 'watch', 'upperRouteName' => 'stpage', 'underRouteName' => 'hrpage'])
</div>
@endsection
