@section('title', '仮会員登録完了')
<link href="{{ asset('/css/st/auth/registerd.css') }}" rel="stylesheet">
@extends('layouts.st.reverse')
@section('content')
@include('components.parts.page_title_reverse', ['title'=>'仮登録が完了しました'])

<div class="container form-wrapper">
  <div class="card">
    <div class="title">本会員登録用リンクを送信しました</div>
    <p>
      会員登録用リンクは、面接図鑑公式LINEから送信されます。<br>
      まだ友達追加が完了していない方は、下のボタンから友達追加をし、送信されているリンクから本会員登録に進んでください。
    </p>
    <a href="https://lin.ee/Fgn5e1O">
      <img src="https://scdn.line-apps.com/n/line_add_friends/btn/ja.png" alt="友だち追加" height="75" border="0">
    </a>
  </div>
</div>
@endsection
