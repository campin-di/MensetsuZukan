@section('title', '面接予約完了')
<link rel="stylesheet" href="{{ asset('css/st/interview/schedule/form_complete.css') }}">
@extends('layouts.st.common')
@section('content')

<div class="container form-wrapper">
  <div class="title">面接予約が完了しました。</div>

  @include('components.parts.button.form.complete_button', ['upperRoute' => '/', 'upperText'=>'トップページに戻る', 'underRoute' => 'mypage', 'underText' => 'マイページに戻る', 'var' => ''])
</div>

<!--
<div class="pop-box">
  <label for="popup-on"><label for="popup-on"><div class="btn-open"><img src="https://homepagenopro.com/wp-content/uploads/2018/08/d11_img_mizudori.png" alt="" class="layer-img"></div></label>
  <input type="checkbox" id="popup-on">
  <div class="popup">
    <label for="popup-on" class="icon-close">×</label>
    <div class="popup-content">
       ポップアップの内容<br>画像もOK<br>
      <img src="https://homepagenopro.com/wp-content/uploads/2018/08/d11_img_mizudori.png" alt="" class="layer-img">
    </div>
    <label for="popup-on"><div class="btn-close">閉じる</div></label>
  </div>
</div>
-->

@endsection
