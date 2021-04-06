@extends('layouts.common_hr')
@section('content')

<div class="container">
  <h1>詳しいプロフィール</h1>
  <a href="{{ route('hr.mypage.detail.show') }}" class="mx-2 btn btn-primary">詳細プロフィールを編集する</a>
  <div>
    <h2>自己紹介</h2>
    <div>
      {{ $hrProfileDetail->introduction }}
    </div>
    <h2>どんな面接ができる？</h2>
    <div>
      {{ $hrProfileDetail->pr }}
    </div>
  </div>

</div>
@endsection
