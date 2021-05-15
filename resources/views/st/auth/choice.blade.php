@extends('layouts.st.reverse')
<link href="{{ asset('/css/st/auth/choice.css') }}" rel="stylesheet">
@section('content')
  <div class="top-content-wrapper">
    <div class="top-content">
      <h1><span class="description">学生</span>会員登録</h1>
    </div>
  </div>

  <div class="container form-wrapper">
    <div class="select-button">
      <button id="st">学生</button>
      <button id="hr">人事</button>
    </div>

    <div class="card">
      <div class="title description">学生</div>
      <span class="description">学生</span>として利用いただけます。
      <p>※登録後に変更できないためご注意ください。</p>
    </div>

    <div class="button-wrapper">
      <a id="url_st" class="button" href="{{ route('register') }}">→</a>
      <a id="url_hr" class="button" href="{{ route('hr.register') }}">→</a>
    </div>
  </div>

  <div class="fixed-register-wrapper">
    <span>既にアカウントをお持ちの方は</span>
    <a id="login_st" href="{{ route('login') }}">ログイン</a>
    <a id="login_hr" href="{{ route('hr.login') }}">ログイン</a>
  </div>

<script type="text/javascript" src="{{ asset('/js/auth/choice.js') }}"></script>
@endsection
