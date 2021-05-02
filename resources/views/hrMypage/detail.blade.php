@extends('layouts.common')
@section('content')

<div class="container">
  <h1>詳しいプロフィール</h1>
  <div>
    <h2>会社</h2>
    <div>
      <a href="">
        {{--会社ページに遷移させる予定--}}
        {{ $profileDetailArray['company'] }}
      </a>
    </div>
    <h2>業界</h2>
    <div>
      {{ $profileDetailArray['industry'] }}
    </div>
    <h2>企業タイプ</h2>
    <div>
      {{ $profileDetailArray['companyType'] }}
    </div>
    <h2>どんな面接ができる？</h2>
    <div>
      {{ $profileDetailArray['pr'] }}
    </div>
  </div>
</div>
@endsection
