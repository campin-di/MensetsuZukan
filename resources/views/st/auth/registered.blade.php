@extends('layouts.st.reverse')
<link href="{{ asset('/css/st/auth/registerd.css') }}" rel="stylesheet">
@section('content')
@include('components.parts.page_title_reverse', ['title'=>'仮登録が完了しました'])


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
