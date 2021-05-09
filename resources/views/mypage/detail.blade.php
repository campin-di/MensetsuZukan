@extends('layouts.st.common')
@section('content')

<div class="container">
  <h1>詳しいプロフィール</h1>
  <a href="{{ route('mypage.detail.show') }}" class="mx-2 btn btn-primary">詳細プロフィールを編集する</a>
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
