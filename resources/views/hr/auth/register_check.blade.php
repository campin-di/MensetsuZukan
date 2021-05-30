@extends('layouts.hr.reverse')
<link href="{{ asset('/css/st/auth/register_check.css') }}" rel="stylesheet">
@section('content')

<div class="top-content-wrapper">
  <div class="top-content">
    <h1>確認画面</h1>
  </div>
</div>

<div class="container form-wrapper">
  <form method="POST" action="{{ route('hr.register') }}">
      @csrf
      <div class="form-input-wrapper">
        <label for="email" class="form-title">メールアドレス</label>
        <div class="form-input">
          <span class="form-control">{{$email}}</span>
          <input type="hidden" name="email" value="{{$email}}">
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
