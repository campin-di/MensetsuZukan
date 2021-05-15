@extends('layouts.st.reverse')
<link href="{{ asset('/css/st/auth/registerd.css') }}" rel="stylesheet">
@section('content')
<div class="top-content-wrapper">
  <div class="top-content">
    <h1>仮会員登録完了</h1>
  </div>
</div>

<div class="container form-wrapper">
  <div class="card">
    <div class="title">メールを送信しました</div>
    <p>
      次のメールアドレスへ「仮登録完了通知」を
      送信いたしましたので、 メールの内容を確認し、
      登録手続きを完了させてください。
    </p>

    <div class="email">
      {{ $email }}
    </div>
  </div>
</div>
@endsection
