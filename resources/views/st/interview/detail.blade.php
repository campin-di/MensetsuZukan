@extends('layouts.st.common')
<link rel="stylesheet" href="{{ asset('css/st/interview/detail.css') }}">
@section('content')

<div class="top-content-wrapper">
  <div class="top-content">
    <h1>面接の情報</h1>
  </div>
</div>

<div class="container content-wrapper">
  <div class="hr-information-wrapper">
    <div class="hr-profile-img">
      <img class="hr-photo" src="{{ asset('/img/yoshi.jpg') }}" alt="プロフィール写真">
    </div>
    <div class="hr-name">
      {{ $interviewInfo->hr_user->name }}
    </div>
    <div class="hr-company">
      {{ $interviewInfo->hr_user->company }}
    </div>
    <div class="hr-pr">
      {{ $interviewInfo->hr_user->pr }}
    </div>
  </div>

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
      <h2>Zoom情報</h2>
    </div>
    <ul class="zoom">
      <li>ミーティングID: 835 7102 3541</li>
      <li>パスコード: upC47Z</li>
    </ul>
  </div>

  <div class="content">
    <div class="content-title">
      <h2>面接場所</h2>
    </div>
    <div class="content-description">
      ＜オンライン＞<br>
      所定の時間になると下記「面接を始める」ボタンが、クリック可能になります。
    </div>
  </div>


  <div class="button-wrapper">
    <button type="submit">
      <a href="{{ $interviewInfo->url }}" target="_blank" rel="noopener noreferrer">
        面接を開始する
      </a>
    </button>
  </div>

  <div class="cancel">
    <a href="{{ route('interview.cancel.confirm', $interviewInfo->id) }}">面接をキャンセルする</a>
  </div>
</div>
<script type="text/javascript" src="{{ asset('/js/st/interview/detail.js') }}"></script>
@endsection
