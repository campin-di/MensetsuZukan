@extends('layouts.common')
@section('content')

<div class="container">
  <h1>詳しいプロフィール</h1>
  @foreach($stProfileDetails as $stProfileDetail)
  <div>
    <h2>自己PR</h2>
    <div>
      {{ $stProfileDetail->pr }}
    </div>
    <h2>ガクチカ</h2>
    <div>
      {{ $stProfileDetail->gakuchika }}
    </div>
    <h2>挫折経験</h2>
    <div>
      {{ $stProfileDetail->frustration }}
    </div>
  </div>
  @endforeach

</div>
@endsection
