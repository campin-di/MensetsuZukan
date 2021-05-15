@extends('layouts.st.reverse')
<link href="{{ asset('/css/st/auth/register_check.css') }}" rel="stylesheet">
@section('content')

<div class="top-content-wrapper">
  <div class="top-content">
    <h1>確認画面</h1>
  </div>
</div>

<div class="container form-wrapper">
  <form method="POST" action="{{ route('register') }}">
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

<!--
      <div class="form-check">
          <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
          <label class="form-check-label" for="remember">
              {{ __('Remember Me') }}
          </label>
      </div>
-->

    <div class="button-wrapper">
      <button type="submit">
        送信する
      </button>
    </div>
  </form>
</div>

<script src="https://code.jquery.com/jquery-2.1.0.min.js" ></script>

@endsection
