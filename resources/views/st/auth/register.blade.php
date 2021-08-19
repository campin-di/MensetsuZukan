@section('title', '新規会員登録')
<link href="{{ asset('/css/st/auth/register.css') }}" rel="stylesheet">
@extends('layouts.st.reverse')
@section('content')

@include('components.parts.page_title_reverse', ['title'=>'新規会員登録'])

<div class="container form-wrapper">
  <h3 class="register-h3">STEP１：面接図鑑公式LINEを友達追加</h3>
  <div class="register-step">
    <ol>
      <li>面接図鑑のご利用にはLINEアカウントが必要です。</li>
      <li>面接図鑑のご利用に必要な情報は公式LINEよりお知らせしますので、ブロックしないでください。</li>
      <li>下の「友だち追加」より、公式LINEの追加を行ってください。</li>
    </ol>
    <hr class="my-3">
    <div class="friend-addition">
      <a class="line-register-wrapper" href="https://lin.ee/Fgn5e1O">
      <div class="my-2 line-register">
        <img style="height:75px" src="{{ asset('/img/icon/line-icon.jpeg') }}">
        <span>友だち追加</span>
      </div>
    </a>
    </div>
  </div>
  <h3 class="register-h3">STEP２：会員登録をする</h3>
  <div class="register-step">
    <div class="mt-3">
      <ol>
        <li>面接図鑑はLINEアカウントでのみ会員登録が可能です。</li>
        <li>本ウェブサービスでは、LINEによる認証ページで許可を得た場合のみメールアドレスを取得します。</li>
        <li>そして、取得されたメールアドレスにつきましては本サービスのログイン以外の目的には一切使用しません。</li>
        <li>もし、既に会員登録されている方が下のボタンをクリック場合、自動的に面接図鑑にログインされます。</li>
      </ol>
    </div>
    <hr class="my-3">
    @include('components.parts.button.line_button', ['text'=>'会員登録', 'routeName'=>'social_login.redirect', 'var'=>'line'])
  </div>
</div>

  <!--
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

      @include('components.parts.button.form.next_button')
    </form>
-->

<script src="https://code.jquery.com/jquery-2.1.0.min.js" ></script>
@endsection
