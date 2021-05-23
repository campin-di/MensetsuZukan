@extends('layouts.hr.common')
<link rel="stylesheet" href="{{ asset('css/hr/unavailable/unavailable.css') }}">
@section('content')
  <div class="block-wrapper">
    <div class="block-background"></div>
      <div class="block">
        <h1>オファーを送るには？</h1>
        <div class="img">
          <img src="../../img/top/features-content-illustration-1.png" alt="仮置き">
        </div>
        <div class="description">
          下記ボタンからお支払い情報を<br>
          入力していただくと、<br>
          全ての面接動画が閲覧可能になり、<br>
          学生にオファーできるようになります！
        </div>
        <a href="">
          <div class="button">
            <span>お支払い情報の入力</span>
          </div>
        </a>
      </div>
  </div>
@endsection
