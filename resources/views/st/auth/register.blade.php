@extends('layouts.st.reverse')
<link href="{{ asset('/css/st/auth/register.css') }}" rel="stylesheet">
@section('content')

<div class="top-content-wrapper">
  <div class="top-content">
    <h1>新規会員登録</h1>
  </div>
</div>

<div class="container form-wrapper">
  <form method="POST" action="{{ route('register.pre_check') }}">
      @csrf
      <div class="form-input-wrapper">
        <label for="email" class="form-title">メールアドレス</label>
        <div class="form-input">
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="mensetsu@example.co.jp" autofocus>
          @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>

      <div class="form-input-wrapper">
        <label for="password" class="form-title">パスワード</label>
        <div class="form-input">
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="8文字以上の英数字で入力してください。" required autocomplete="current-password">

          @error('password')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>
      </div>

      <div class="form-input-wrapper">
        <label for="password-confirm" class="form-title">パスワードの確認</label>
        <div class="form-input">
          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="再度パスワードを入力してください。" required autocomplete="new-password">
        </div>
      </div>

      @include('components.button.form.next_button')
    </form>
  </div>

<script src="https://code.jquery.com/jquery-2.1.0.min.js" ></script>
@endsection
