@extends('layouts.common_hr')
@section('content')

<div class="container">
  <h1>詳しいプロフィール</h1>
  <h2>自己紹介</h2>
  <div>
    {{ $profileCollection[0]['pr'] }}
  </div>
  <h2>ガクチカ</h2>
  <div>
    {{ $profileCollection[0]['gakuchika'] }}
  </div>
  <h2>挫折経験</h2>
  <div>
    {{ $profileCollection[0]['frustration'] }}
  </div>

</div>
@endsection
