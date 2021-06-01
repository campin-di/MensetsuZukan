@extends('layouts.st.common')
@section('content')
<link rel="stylesheet" href="{{ asset('css/st/mypage/their_page.css') }}">

<div class="container">
  <h1 class="container_title">マイページ</h1>

  @include('components.parts.profile',['imagePath' => $userDataArray['imagePath'], 'isHr' => '', 'userName' => '', 'nickName' => $userDataArray['nickname'], 'description' => $userDataArray['graduate_year'] .'年卒/'. $userDataArray['industry'], 'introduction' => $userDataArray['introduction'] ])

  <div class="container_profile_btn">
    <a href="{{ route('stpage.detail', $userDataArray['stId']) }}" class="mx-2 btn btn-primary container_profile_btn_profile">プロフィール詳細</a>
  </div>

  <div class="container_pastVideo">
    <h2 class="container_pastVideo_title">過去の面接動画</h2>
  </div>

  @include('components.parts.video_content',['videosCollection' => $pastVideosCollection, 'isHr' => '',])

</div>
@endsection
