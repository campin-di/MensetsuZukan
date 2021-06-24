@section('title', '仮会員登録')
<link href="{{ asset('/css/st/auth/choice.css') }}" rel="stylesheet">
@extends('layouts.st.reverse')
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

    @include('components.parts.button.next_button', ['routeName' => 'register'])
  </div>

  <div id="login-wrapper">
    @include('components.parts.button.fixed_button',['routeName' => 'login', 'var'=>'', 'msg' => '既にアカウントをお持ちの方は', 'text' => 'ログイン'])
  </div>

  <script type="text/javascript" src="{{ asset('/js/auth/choice.js') }}"></script>
@endsection
