@extends('layouts.st.common')
<link rel="stylesheet" href="{{ asset('css/st/hrMypage/mypage.css') }}">
@section('content')

@include('components.parts.page_title', ['title'=>'マイページ'])


<div class="container">
  @include('components.parts.profile', ['imagePath' => $userDataArray['imagePath'], 'userName' => $userDataArray['name'], 'nickName' => '', 'description' => $userDataArray['company'], 'introduction' => $userDataArray['introduction'] ])

  <div class="container_profile_btn">
    <a href="{{ route('hrpage.detail', $userDataArray['id']) }}" class="mx-2 btn btn-primary container_profile_btn_profile">詳しいプロフィールを見る</a>
  </div>

  @include('components.parts.button.fixed_button',['routeName' => 'interview.schedule', 'ver' => $userDataArray['id'], 'msg' => '', 'text' =>  $userDataArray['name'] .'さんとの面接を予約する。'])

  <h2>過去の面接</h2>
  @include('components.parts.video_content',['videosCollection' => $pastVideosCollection, 'isHr'=>''])

</div>
@endsection
