@section('title', '採点完了')
<link rel="stylesheet" href="{{ asset('css/st/interview/schedule/form_complete.css') }}">
@extends('layouts.hr.common')
@section('content')

  <div class="container form-wrapper">
    <div class="title">採点を完了しました。</div>

    @include('components.parts.button.form.complete_button', ['upperRoute' => '/', 'upperText'=>'トップページに戻る', 'underRoute' => 'hr.mypage', 'var'=>'', 'underText' => 'マイページに戻る'])
  </div>
@endsection
