@section('title', 'アップロード処理完了')
<link rel="stylesheet" href="{{ asset('css/st/interview/schedule/form_complete.css') }}">
@extends('layouts.st.common')
@section('content')

<div class="container form-wrapper">
  <div class="title">動画のアップロードが完了しました。</div>

  @include('components.parts.button.form.complete_button', ['upperRoute' => '/', 'upperText'=>'トップページに戻る', 'underRoute' => 'admin', 'underText' => '管理画面に戻る', 'var' => ''])
</div>
@endsection
