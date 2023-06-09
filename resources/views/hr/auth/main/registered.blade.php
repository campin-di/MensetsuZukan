@section('title', '会員登録が完了しました')
<link href="{{ asset('/css/st/auth/main/registerd.css') }}" rel="stylesheet">
@extends('layouts.hr.reverse')
@section('content')
@include('components.parts.page_title_reverse', ['title'=>'本登録が完了しました'])

<div class="container form-wrapper">
  <div class="title">デジマ面接図鑑をご利用ください。</div>

  @include('components.parts.button.form.complete_button', ['upperRoute' => '/', 'upperText'=>'トップページに戻る', 'underRoute' => 'hr.login', 'underText' => 'ログイン', 'var' => ''])
</div>
@endsection
