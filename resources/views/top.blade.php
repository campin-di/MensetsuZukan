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
      他の就活生は、いったいどんな面接をしているの？<br>
      あらゆる業界の人事・学生の面接が得点付きで見放題！<br>
      自身が面接を受けると、企業からのオファーも貰えます！<br>
    </p>
    <img class="pc-img" src="./img/.png" alt="PCイラスト">
  </div>
</div>

<div>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('register.choice') }}">新規会員登録</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('login') }}">ログイン</a>
  </li>
</div>

@endsection
