@section('title', '面接見放題まであと少し！')
<link rel="stylesheet" href="{{ asset('css/st/unavailable/unavailable.css') }}">
@extends('layouts.st.common')
@section('content')
  <div class="block-wrapper">
    <div class="block-background"></div>
      <div class="block">
        <h1>面接を見るためには？</h1>
        <div class="img">
          <img src="{{ asset('img/unavailable/unavailable-contributor.svg') }}" alt="面接官を探しているイラスト">
        </div>
      <div class="description">
        下記ボタンからお支払い情報の設定を<br>
        していただけると登録完了です！<br>
        すぐに気になる企業・就活生の面接を<br>
        チェックしましょう！<br>
      </div>
        <a href="{{ route('subscription.audience') }}">
          <div class="button">
            <span>お支払い情報の設定</span>
          </div>
        </a>
      </div>
  </div>
@endsection
