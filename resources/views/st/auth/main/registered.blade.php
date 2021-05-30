@extends('layouts.st.reverse')
<link href="{{ asset('/css/st/auth/main/registerd.css') }}" rel="stylesheet">
@section('content')
<div class="top-content-wrapper">
  <div class="top-content">
    <h1>本会員登録完了</h1>
  </div>
</div>

<div class="container form-wrapper">
  <div class="title">面接図鑑の利用をお楽しみください。</div>

  @include('components.button.form.complete_button', ['upperRoute' => '/', 'upperText'=>'トップページに戻る', 'underRoute' => 'login', 'underText' => 'ログイン'])

</div>
@endsection
