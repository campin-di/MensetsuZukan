@section('title', '面接予約完了')
<link href="{{ asset('/css/st/auth/registerd.css') }}" rel="stylesheet">
@extends('layouts.st.reverse')
@section('content')
@include('components.parts.page_title_reverse', ['title'=>'候補日の削除が完了しました'])

<div class="container form-wrapper">
  @include('components.parts.button.form.complete_button', ['upperRoute' => '/', 'upperText'=>'トップページに戻る', 'underRoute' => 'mypage', 'var'=>'', 'underText' => 'マイページに戻る'])
</div>
@endsection
