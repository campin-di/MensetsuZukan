@extends('layouts.common')
@section('content')

<div class="container">
  <h1>面接の情報</h1>
  名前：{{ $interviewInfo->hr_user->name }}<br>
  企業：{{ $interviewInfo->hr_user->company }}<br>
  日時：{{ $interviewInfo->date }}：{{ $interviewInfo->time }}<br>
  URL：{{ $interviewInfo->url }}<br>
  <div>
    <a href="{{ $interviewInfo->url }}" target="_blank" rel="noopener noreferrer">
      面接を開始する。
    </a>
  </div>
  <div>
    <a href="{{ route('interview.cancel') }}">面接をキャンセルする</a>
  </div>

  <a href="{{ route('mypage') }}">マイページに戻る</a>
</div>
@endsection
