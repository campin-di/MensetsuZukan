@section('title', '面接のキャンセル完了')
<link rel="stylesheet" href="{{ asset('css/st/interview/schedule/form_complete.css') }}">
@extends('layouts.st.common')
@section('content')

<div class="container form-wrapper">
  <div class="title">面接のキャンセルが完了しました。</div>

  @include('components.parts.button.form.complete_button', ['upperRoute' => '/', 'upperText'=>'トップページに戻る', 'underRoute' => 'mypage', 'underText' => 'マイページに戻る', 'var' => ''])

</div>
@endsection
