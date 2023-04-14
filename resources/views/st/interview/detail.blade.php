@section('title', '面接情報の確認')
<link rel="stylesheet" href="{{ asset('css/st/interview/detail.css') }}">
@extends('layouts.st.common')
@section('content')

<div class="top-content-wrapper">
  <div class="top-content">
    <h1>面接の情報</h1>
  </div>
</div>

<div class="container content-wrapper">
  @include('components.parts.profile',['imagePath' => $interviewInfo->hr_user->image_path, 'isHr' => '', 'userName' => '', 'nickName' => $interviewInfo->hr_user->nickname, 'description' => $interviewInfo->hr_user->industry, 'introduction' => $interviewInfo->hr_user->pr ])

  <div class="content">
    <div class="content-title">
      <h2>日時</h2>
    </div>
    <div class="date">
      {{ $interviewInfo->date }}：{{ $interviewInfo->time }}
    </div>
  </div>

  <div class="content">
    <div class="content-title">
      <h2>zoom情報</h2>
    </div>
    <ul class="zoom">
      <li>ミーティングID: {{ $interviewInfo->zoomId }}</li>
      <li>パスコード: {{ $interviewInfo->zoomPass }}</li>
    </ul>
  </div>

  <div class="content">
    <div class="content-title">
      <h2>面接場所</h2>
    </div>
    <div class="content-description">
      ＜オンライン＞<br>
      所定の時間に「面接を開始」ボタンから、面接を開始してください。
    </div>
  </div>

  <div class="attention-wrapper">
    <h2>注意事項</h2>
    <ul class="attention">
      <li>zoomは、PCから開くようにしてください。</li>
      <li>面接中は本名などの個人が特定される情報は口外しないでください。</li>
      <li>リンクが開かない場合は上記zoom情報を、zoomアプリに入力して入室してください。</li>
      <li>「ポップアップをブロックしました。」等の表示が画面右上に出てきたときは、「ポップアップを許可する」を押してください。</li>
    </ul>
  </div>

  <div class="button-wrapper">
    <button type="submit">
      <a href="{{ $interviewInfo->zoomUrl }}" target="_blank" rel="noopener noreferrer">
        面接を開始
      </a>
    </button>
  </div>
</div>
<script type="text/javascript" src="{{ asset('/js/st/interview/detail.js') }}"></script>
@endsection
