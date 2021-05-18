@extends('layouts.st.common')
<link rel="stylesheet" href="{{ asset('css/st/interview/schedule/form_complete.css') }}">
@section('content')

<div class="container form-wrapper">
  <div class="title">面接のキャンセルが完了しました。</div>

  <div class="upper-button">
    <a href="{{ url('/') }}">トップページに戻る</a>
  </div>
  <div class="under-button">
    <a href="{{ route('mypage') }}">マイページに戻る</a>
  </div>
</div>
@endsection
