@section('title', '面接情報の確認')
<link rel="stylesheet" href="{{ asset('css/hr/interview/detail.css') }}">
@extends('layouts.hr.common')
@section('content')

@include('components.parts.page_title', ['title'=>'面接の情報'])

<div class="container content-wrapper">
  <div class="st-information-wrapper">
    <div class="st-profile-img">
      <img class="st-photo" src="{{ asset($interviewInfo->st_user->image_path) }}" alt="プロフィール写真">
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
      所定の時間に「面接を開始」ボタンから、面接を開始してください。
    </div>
  </div>
  
  @if($flag == 2)
    <div class="button-wrapper uppest">
      <button type="submit">
        <a href="{{ route('hr.interview.scoring.form', $interviewInfo->id) }}">採点を行う</a>
      </button>
    </div>
  @else

  <div class="attention-wrapper">
    <h2>注意事項</h2>
    <ul class="attention">
      <li>zoomは、PCから開くようにしてください。</li>
      <li>個人が特定される情報を、学生が面接中に口外しないように喚起してください。</li>
      <li>リンクが開かない場合は上記zoom情報を、zoomアプリに入力して入室してください。</li>
      <li>「ポップアップをブロックしました。」等の表示が画面右上に出てきたときは、「ポップアップを許可する」を押してください。</li>
    </ul>
  </div>

  <div class="button-wrapper">
    <a href="{{ route('hr.interview.pre', $interviewInfo->id) }}">
      <button type="submit">
        面接を開始
      </button>
    </a>
  </div>
  <div class="cancel">
    <a href="{{ route('hr.interview.cancel.confirm', $interviewInfo->id) }}">面接をキャンセルする</a>
  </div>
  @endif
</div>
<script type="text/javascript" src="{{ asset('/js/st/interview/detail.js') }}"></script>
@endsection
