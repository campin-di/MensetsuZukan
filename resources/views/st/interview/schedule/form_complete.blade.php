@extends('layouts.common')
@section('content')

<div>
  面接予約が完了しました。
</div>

<a href="{{ route('home') }}">トップページに戻る</a>
<a href="{{ route('mypage') }}">マイページに戻る</a>
@endsection
