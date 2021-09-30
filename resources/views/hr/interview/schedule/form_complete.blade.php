@section('title', '面接予約完了画面')
<link rel="stylesheet" href="{{ asset('css/st/interview/schedule/form_complete.css') }}">
@extends('layouts.hr.common')
@section('content')

<div class="container form-wrapper">
  @if(!$duplicateFlag)
    <div class="title">面接予約が完了しました。</div>
  @else
    <div class="title">面接日程が別面接と重複しました</div>

    <div class="message-card">
      <p>
        学生と別日程を決めていただき、再度面接予約をお願いいたします。
      </p>  
      <p>
        面接日程の変更を希望される場合は、マイページ「面接予定」から該当する面接予定をキャンセルした上で、再度面接予約を行ってください。
      </p>
    </div>

  @endif

  @include('components.parts.button.form.complete_button', ['upperRoute' => '/', 'upperText'=>'トップページに戻る', 'underRoute' => 'hr.mypage', 'var'=>'', 'underText' => 'マイページに戻る'])
</div>
@endsection
