@extends('layouts.hr.reverse')
<link href="{{ asset('/css/st/auth/main/registerd.css') }}" rel="stylesheet">
@section('content')
@include('components.parts.page_title_reverse', ['title'=>'本登録が完了しました'])

<div class="container form-wrapper">
  <div class="title">面接図鑑をご利用ください。</div>

  @include('components.parts.button.form.complete_button', ['upperRoute' => '/', 'upperText'=>'トップページに戻る', 'underRoute' => 'hr.login', 'underText' => 'ログイン', 'var' => ''])
</div>
@endsection
