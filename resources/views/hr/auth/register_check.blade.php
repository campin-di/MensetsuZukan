@section('title', '仮会員登録完了')
<link href="{{ asset('/css/st/auth/register_check.css') }}" rel="stylesheet">
@section('title', '入力内容の確認')
@extends('layouts.hr.reverse')
@section('content')

@include('components.parts.page_title_reverse', ['title'=>'入力内容の確認'])

<div class="container form-wrapper">
  <form method="POST" action="{{ route('hr.register') }}">
      @csrf
      <div class="form-input-wrapper">
        <label for="email" class="form-title">メールアドレス</label>
        <div class="form-input">
          <span class="form-control">{{ $email }}</span>
          <input type="hidden" name="email" value="{{ $email }}">
        </div>
      </div>

      <div class="form-input-wrapper">
        <label for="password" class="form-title">パスワード</label>
        <div class="form-input">
          <span class="form-control">{{$password_mask}}</span>
          <input type="hidden" name="password" value="{{$password}}">
        </div>
      </div>

      @include('components.parts.button.form.transition_button', ['text'=>'送信'])
  </form>
</div>

@endsection
