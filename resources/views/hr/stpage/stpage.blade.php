@section('title', $userData->name.'さんのマイページ')
<link rel="stylesheet" href="{{ asset('css/st/mypage/mypage.css') }}">
@extends('layouts.hr.nofooter')
@section('content')
  @include('components.parts.page_title', ['title'=>'マイページ'])

  <div class="container">
    @include('components.parts.profile', ['imagePath' => $userData->image_path, 'userName' => $userData->name, 'nickName' => '('. $userData->nickname. ')', 'description' => $userData->graduate_year .'年卒 / '. $userData->industry. '業界 志望', 'introduction' => $userData->introduction ])

    <div class="container_profile_btn">
      <a href="{{ route('hr.stpage.detail', $userData->id) }}" class="mx-2 btn btn-primary container_profile_btn_profile">詳しいプロフィール</a>
      @if($userData->graduate_year == 2022)
        <a disable=”disabled” onclick="OnLinkClick();" class="mx-2 btn btn-secondary container_profile_btn_offer">就活終了</a>
      @else
        <a href="{{ route('hr.offer.form', $userData->id) }}" class="mx-2 btn btn-primary container_profile_btn_offer">オファーする</a>       
      @endif
    </div>
  </div>

  @if($userData->graduate_year != 2022)
    @include('components.parts.button.fixed_button',['routeName' => 'hr.offer.form', 'var'=>$userData->id, 'msg' => '', 'text' => $userData->name.'さんにオファーを送る'])
  @endif

  <div class="container_pastVideo">
    <h2 class="container_schedule_title">過去の面接動画</h2>
  </div>
  @include('components.parts.video_content',['videosCollection' => $pastVideosCollection, 'routeName'=>'hr.watch', 'upperRouteName' => 'hr.stpage', 'underRouteName' => 'hr.hrpage'])

  <script language="javascript" type="text/javascript">
    function OnLinkClick() {
      alert('就活が終了しているためオファーできません。')
    }
  </script>
@endsection
