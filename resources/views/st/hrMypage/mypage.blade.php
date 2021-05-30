@extends('layouts.st.common')
<link rel="stylesheet" href="{{ asset('css/st/hrMypage/mypage.css') }}">
@section('content')

@include('components.page_title', ['title'=>'マイページ'])


<div class="container">
  @include('components.profile', ['imgPath' => 'img/yoshi.jpg', 'userName' => $userDataArray['name'], 'nickName' => '', 'description' => $userDataArray['company'], 'introduction' => 'Somy株式会社の人事部 吉田裕哉です。大手からベンチャーまで幅広い人事経験があります。素敵な出会いを楽しみにしております！' ])

  <div class="container_profile_btn">
    <a href="{{ route('hr_mypage.detail', $userDataArray['id']) }}" class="mx-2 btn btn-primary container_profile_btn_profile">詳しいプロフィールを見る</a>
  </div>

  @include('components.button.fixed_button',['routeName' => 'interview.schedule', 'ver' => $userDataArray['id'], 'msg' => '', 'text' =>  $userDataArray['name'] .'さんとの面接を予約する。'])

  <h2>過去の面接</h2>
  @include('components.video_content',['videosCollection' => $pastVideosCollection])

</div>
@endsection
