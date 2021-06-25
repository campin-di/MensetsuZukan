@section('title', '質問リスト作成完了')
<link rel="stylesheet" href="{{ asset('css/st/interview/schedule/form_complete.css') }}">
@extends('layouts.hr.common')
@section('content')

<div class="container form-wrapper">
  <div class="title">質問リストの作成を完了しました。</div>


  @include('components.parts.button.form.complete_button', ['upperRoute' => '/hr/mypage', 'upperText'=>'マイページに戻る', 'underRoute' => 'hr.interview.detail', 'var'=>$id, 'underText' => '面接の詳細ページに戻る'])
</div>
@endsection
