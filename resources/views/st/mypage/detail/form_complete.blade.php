@section('title', '登録内容が変更されました。')
<link rel="stylesheet" href="{{ asset('css/st/mypage/basic/form_complete.css') }}">
@extends('layouts.st.common')
@section('content')

<div class="container form-wrapper">
  <div class="title">変更が完了しました。</div>

  @include('components.parts.button.form.complete_button', ['upperRoute' => '/', 'upperText'=>'トップページに戻る', 'underRoute' => 'mypage', 'underText' => 'マイページに戻る', 'var' => ''])
</div>

@endsection
