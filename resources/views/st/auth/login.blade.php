@section('title', '学生ログイン')
<link href="{{ asset('/css/st/auth/login.css') }}" rel="stylesheet">

@extends('layouts.st.nofooter')
@section('content')
  @include('components.parts.page_title', ['title'=>'メールアドレスで会員登録した方'])

  <div class="container form-wrapper">
    <form method="POST" action="{{ route('login') }}">
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

        <div class="button-wrapper">
          @include('components.parts.button.form.transition_button', ['text' => 'ログイン'])

          @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
              パスワードを忘れた場合
            </a>
          @endif
        </div>

        <div class="to-hr-wrapper">
          <a class="to-hr" href="{{ route('hr.login') }}">採用担当者の方はこちら</a>
        </div>
      </div>
      <div class="container form-wrapper">
        @include('components.parts.page_title', ['title'=>'LINEで会員登録をした方'])

        <div class="mt-3">
          <ol>
            <li>LINEで会員登録をした方のみボタンをクリックしてください。</li>
            <li>未会員登録ユーザーがクリックすると仮会員登録を行います。</li>
          </ol>
        </div>
        <hr class="my-3">
        @include('components.parts.button.line_button', ['text'=>'ログイン', 'routeName'=>'social_login.redirect', 'var'=>'line'])
      </div>
    </form>

    @include('components.parts.button.fixed_button', ['routeName' => 'register.choice', 'var'=>'', 'msg' => 'まだ会員登録されていない方は', 'text' => '新規会員登録'])
  <script src="https://code.jquery.com/jquery-2.1.0.min.js" ></script>
@endsection
