@extends('layouts.common')
@section('content')
<div class="header-wrapper">
  <div>
    <img src="{{ asset('/img/logo_origin.png') }}" alt="ロゴ">
    <P>
      現役人事が採点した<br>
      就活生の面接が見放題！
    </p>
    <p>
      サービス紹介をここに書きます。<br>
      サービスの紹介をここに書きます。サービスの紹介<br>
      ここに書きます。サービスの紹介をここに<br>
      書きます。サービス紹介を  <br>
      ここに書きます。<br>
    </p>
    <img class="pc-img" src="./img/.png" alt="PCイラスト">
  </div>
</div>

<div>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('register') }}">新規会員登録</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('login') }}">ログイン</a>
  </li>
</div>

@endsection
