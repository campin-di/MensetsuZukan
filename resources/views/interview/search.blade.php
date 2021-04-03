@extends('layouts.common')
@section('content')

<div class="container">
  <h1>人事を探す</h1>
  @foreach($hrCollection as $hr)
  <div>
    <a href="{{ route('mypage') }}">
      {{ $hr['name'] }}<br>
    </a>
      {{ $hr['introduction'] }}
  </div>
  <hr>
  @endforeach

</div>
@endsection
