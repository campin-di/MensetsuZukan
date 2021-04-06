@extends('layouts.common')
@section('content')

<div class="container">
  <h1>詳しいプロフィール</h1>
  <div>
    <h2>自己紹介</h2>
    <div>
      {{ $profileCollection[0]['introduction'] }}
    </div>
    <h2>どんな面接ができる？</h2>
    <div>
      {{ $profileCollection[0]['pr'] }}
    </div>
  </div>

</div>
@endsection
