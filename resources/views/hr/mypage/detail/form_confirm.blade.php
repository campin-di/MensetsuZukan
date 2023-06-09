@section('title', '変更内容の確認')
<link href="{{ asset('/css/st/mypage/detail/form_confirm.css') }}" rel="stylesheet">
@extends('layouts.hr.common')
@section('content')
@include('components.parts.page_title', ['title'=>'確認画面'])

<div class="container form-wrapper">
  <form method="post" action="{{ route('hr.mypage.detail.send') }}">
    @csrf
    @foreach($confirmArray as $key => $content)
      <div class="form-input-wrapper">
        <label for="email" class="form-title">{{ $key }}</label>
        <div class="form-input">
          <span class="form-control">{{ $content }}</span>
        </div>
      </div>
    @endforeach

    @include('components.parts.button.form.transition_button', ['text'=>'送信'])
  </form>
</div>
@endsection
