@extends('layouts.hr.common')
<link rel="stylesheet" href="{{ asset('css/hr/interview/offer/form.css') }}">
@section('content')

<div class="top-content-wrapper">
  <div class="top-content">
    <h1>オファー内容の決定</h1>
  </div>
</div>

<div class="container offer-wrapper">
  <div class="st-information-wrapper">
    <div class="st-profile-img">
      <img class="st-photo" src="{{ asset('/img/yoshi.jpg') }}" alt="プロフィール写真">
    </div>
    <div class="st-name">
      {{ $stData->name }}
    </div>
    <div class="st-company">
      {{ $stData->university }}・{{ $stData->faculty }}
    </div>
  </div>

  <form method="post" action="{{ route('hr.offer.post') }}">
    @csrf

    <div class="content-title">
      <h2>オファー内容</h2>
    </div>
    <div class="content-offer">
      <select name="offer_content">
        <option value="2次面接から（Webテスト無）"> 2次面接から（Webテスト無）</option>
        <option value="2次面接から（Webテスト有）">2次面接から（Webテスト有）</option>
        <option value="インターン招待（選考免除）">インターン招待（選考免除）</option>
        <option value="インターン招待（Webテストのみ）">インターン招待（Webテストのみ）</option>
      </select>
    </div>
    <div class="content-title">
      <h2>オファー理由</h2>
    </div>
    <div class="content-msg">
      <textarea name="message" placeholder="オファー理由・オファー条件詳細など、1000文字以内で入力してください。" required></textarea>
    </div>
    <input type="hidden" name="stId" value="{{ $stData->id }}">

    @include('components.parts.button.form.next_button')
  </form>
</div>
<script src="{{ asset('/js/offer.js') }}"></script>
@endsection
