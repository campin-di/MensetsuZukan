@extends('layouts.hr.common')
<link rel="stylesheet" href="{{ asset('css/hr/interview/detail.css') }}">
@section('content')

@include('components.parts.page_title', ['title'=>'面接の情報'])

<div class="container content-wrapper">
  <div class="st-information-wrapper">
    <div class="st-profile-img">
      <img class="st-photo" src="{{ asset('/img/yoshi.jpg') }}" alt="プロフィール写真">
    </div>
    <div class="st-name">
      {{ $interviewInfo->st_user->name }}
    </div>
    <div class="st-company">
      {{ $interviewInfo->st_user->university }}・{{ $interviewInfo->st_user->faculty }}
    </div>
    <div class="st-pr">
      {{ $interviewInfo->st_user->introduction }}
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
      所定の時間になると下記「面接を始める」ボタンが、クリック可能になります。
    </div>
  </div>

  @if($flag == 0)
    <div class="button-wrapper uppest">
      <button type="submit">
        <a href="{{ route('hr.interview.question.add', $interviewInfo->id) }}">質問リストの作成</a>
      </button>
    </div>
    <div class="button-wrapper-unavailable">
      <span>面接を開始</span>
    </div>
    @elseif($flag == 1)
    <div class="button-wrapper edit uppest">
      <button type="submit">
        <a href="{{ route('hr.interview.question.edit', $interviewInfo->id) }}">質問リストの変更</a>
      </button>
    </div>
    <div class="button-wrapper dl">
      <button type="submit">
        <a href="">質問シートをダウンロード</a>
      </button>
    </div>
    <div class="button-wrapper">
      <button type="submit">
        <a href="{{ route('hr.interview.pre', $interviewInfo->id) }}">面接を開始</a>
      </button>
    </div>
    @elseif($flag == 2)
    <div class="button-wrapper uppest">
      <button type="submit">
        <a href="{{ route('hr.interview.scoring.form', $interviewInfo->id) }}">面接が終了した</a>
      </button>
    </div>
    @else
  @endif


</div>
<script type="text/javascript" src="{{ asset('/js/st/interview/detail.js') }}"></script>
@endsection
