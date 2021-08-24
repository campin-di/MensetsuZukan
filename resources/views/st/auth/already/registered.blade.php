@section('title', '仮会員登録完了')
<link href="{{ asset('/css/st/auth/registerd.css') }}" rel="stylesheet">
@extends('layouts.st.reverse')
@section('content')
@include('components.parts.page_title_reverse', ['title'=>'LINEアカウントの連携完了'])

<div class="container form-wrapper">
  <div class="card">
    <div class="title">LINEアカウント連携が完了しました！</div>
    <p>
      次回からLINEを用いてログインしてください。<br><br>
      面接図鑑「公式LINE」の友だち追加が完了していない方は、下のボタンから追加してください。<br>
      オファーなどの連絡は公式LINEを通して行われますので、ブロックしないようにしてください。
    </p>
    <a href="https://lin.ee/Fgn5e1O">
      <img class="line-add-img" src="https://scdn.line-apps.com/n/line_add_friends/btn/ja.png" alt="友だち追加">
    </a>
  </div>
</div>
@endsection
