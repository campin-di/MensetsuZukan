@extends('layouts.hr.common')
<link rel="stylesheet" href="{{ asset('css/st/interview/schedule/form_complete.css') }}">
@section('content')

<div class="container form-wrapper">
  <div class="title">質問リストの作成を完了しました。</div>


  @include('components.parts.button.form.complete_button', ['upperRoute' => '/hr/mypage', 'upperText'=>'マイページに戻る', 'underRoute' => 'hr.interview.detail', 'var'=>$id, 'underText' => '面接の詳細ページに戻る'])
</div>
@endsection
