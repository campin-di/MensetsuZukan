@extends('layouts.hr.common')
<link href="{{ asset('/css/st/auth/login.css') }}" rel="stylesheet">
@section('content')

<div class="container">
  <div class="top-content">
    <h1>人事ログイン</h1>
  </div>

      <form method="POST" action="{{ route('hr.login') }}">
          @csrf

          <div class="form-input-wrapper">
            <label for="email" class="form-title">メールアドレス</label>
            <div class="form-input">
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
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
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

              @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
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
                  ログイン
              </button>

              @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                  パスワードを忘れた場合
                </a>
              @endif
          </div>

          <div class="to-hr-wrapper">
            <a class="to-hr" href="{{ route('login') }}">学生の方はこちら</a>
          </div>
      </form>
    </div>

      <div class="fixed-register-wrapper">
        <span>まだ会員登録されていない方は</span>
        <a href="{{ route('register.choice') }}">新規会員登録</a>
      </div>
<script src="https://code.jquery.com/jquery-2.1.0.min.js" ></script>
<script>

</script>
@endsection
