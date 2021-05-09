@extends('layouts.st.common')
@section('content')

<div class="container">
  <h1>詳しいプロフィール</h1>
  <div>
    <h2>強み</h2>
    <div>
      {{ $profileDetailArray['strengths'] }}
    </div>
    <h2>ガクチカ</h2>
    <div>
      {{ $profileDetailArray['gakuchika'] }}
    </div>
    <h2>私の性格</h2>
    <div>
      {{ $profileDetailArray['personality'] }}
    </div>
  </div>
</div>
@endsection
