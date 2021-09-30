@section('title', '面接可能日の確認')
<link rel="stylesheet" href="{{ asset('css/st/mypage/basic/form_complete.css') }}">
@extends('layouts.hr.common')
@section('content')

<div class="container form-wrapper">
  <div class="title">送信しました。</div>

  @include('components.parts.button.form.complete_button', ['upperRoute' => '/', 'upperText'=>'トップページに戻る', 'underRoute' => 'hr.interview.request', 'var'=>'', 'underText' => '他の面接リクエストを見る'])
</div>
@endsection
