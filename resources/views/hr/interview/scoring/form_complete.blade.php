@extends('layouts.hr.common')
<link rel="stylesheet" href="{{ asset('css/st/interview/schedule/form_complete.css') }}">
@section('content')

  <div class="container form-wrapper">
    <div class="title">採点を完了しました。</div>

    <div class="upper-button">
      <a href="{{ route('hr.hr_home') }}">トップページに戻る</a>
    </div>
    <div class="under-button">
      <a href="{{ route('hr.mypage') }}">マイページに戻る</a>
    </div>
  </div>
@endsection
