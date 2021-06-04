@extends('layouts.hr.common')
<link rel="stylesheet" href="{{ asset('css/st/mypage/basic/form_complete.css') }}">
@section('content')

<div class="container form-wrapper">
  <div class="title">変更が完了しました。</div>

  @include('components.parts.button.form.complete_button', ['upperRoute' => '/', 'upperText'=>'トップページに戻る', 'underRoute' => 'hr.mypage', 'underText' => 'マイページに戻る'])
</div>
@endsection
