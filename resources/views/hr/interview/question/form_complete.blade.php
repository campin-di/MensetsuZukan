@extends('layouts.hr.common')
<link rel="stylesheet" href="{{ asset('css/st/interview/schedule/form_complete.css') }}">
@section('content')

<div class="container form-wrapper">
  <div class="title">質問リストの作成を完了しました。</div>

  <div class="upper-button">
    <a href="{{ route('hr.mypage') }}">マイページに戻る</a>
  </div>
  <div class="under-button">
    <a href="{{ route('hr.interview.detail', $id) }}">面接情報の詳細ページに戻る</a>
  </div>
</div>
@endsection
