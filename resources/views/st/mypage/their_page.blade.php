@extends('layouts.st.common')
@section('content')
<link rel="stylesheet" href="{{ asset('css/st/mypage/their_page.css') }}">

<div class="container">
  <h1 class="container_title">マイページ</h1>

  @include('components.profile', ['imagePath' => $userDataArray['imagePath'], 'userName' => '', 'nickName' => $userDataArray['nickname'], 'description' => '地方〇〇/〇〇業界志望/〇〇卒', 'introduction' => '地方国立理系です！長期インターンや留学の経験がなく、アルバイト経験のみで頑張っています！' ])

  <div class="container_profile_btn">
    <a href="{{ route('mypage.theirDetail', $userDataArray['stId']) }}" class="mx-2 btn btn-primary container_profile_btn_profile">プロフィール詳細</a>
  </div>

  <div class="container_pastVideo">
    <h2 class="container_pastVideo_title">過去の面接動画</h2>
  </div>

  @include('components.video_content',['videosCollection' => $pastVideosCollection])

</div>
@endsection
