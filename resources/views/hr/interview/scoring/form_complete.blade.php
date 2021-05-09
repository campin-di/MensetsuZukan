@extends('layouts.hr.common')
@section('content')
  <h3>採点を完了しました。</h3>

  <div>
    <a href="{{ route('hr.hr_home') }}">トップページに戻る</a>
  </div>
  <div>
    <a href="{{ route('hr.mypage') }}">マイページに戻る</a>
  </div>
@endsection
