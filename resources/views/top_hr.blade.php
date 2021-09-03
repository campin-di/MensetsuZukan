@extends('layouts.common_top_hr')
@section('content')
<div class="firstview-wrapper">
  <div class="firstview-content">
    <div class="flex-pc">
      <div class="left-child-pc">
        <img class="firstview-logo" src="{{ asset('/img/logo/logo_white.png') }}" alt="ロゴ">
        <P class="firstview-main-msg">
          現役人事が徹底分析した<br>
          学生の模擬面接が見放題。
        </p>
        <p class="firstview-sub-msg">
          ソフトスキルが測れる面接動画に加え、現役人事による定量・定性的な評価も公開しています。<br>
          自社で活躍出来る人材かどうか、最も多くの判断材料をもって検討できます。<br>
        </p>
      </div>
      <div class="right-child-pc">
        <img class="firstview-pc-img" src="{{ asset('/img/top/firstview-pc.svg') }}" alt="PCイラスト">
      </div>
    </div>
    <div class="firstview-register-wrapper">
      <span class="firstview-register-upper">面接図鑑について詳しく知りたい方は</span>
      <a href="#contact">
        <div class="firstview-register-button updown-btn">
          お問い合わせ
        </div>
      </a>
      <a href="/">
        <div class="firstview-hr-button">
          学生はこちら
        </div>
      </a>
    </div>
  </div>
</div>

<div class="bottom-fixed-button">
  <a href="{{ route('register.choice') }}">
    <li class="bottom-button-left">
      新規会員登録
    </li>
  </a>
  <a href="{{ route('login') }}">
    <li class="bottom-button-right">
      ログイン
    </li>
  </a>
</div>

<div class="features-wrapper">
  <h1>面接図鑑の特徴</h1>
  <div class="flex-pc">
    <div class="features-content-wrapper hover-action">
      <span>01</span>
      <h2>全ての面接が見放題！</h2>
      <div class="features-content flex">
        <div class="features-content-description left-child">
          23卒の面接動画が見放題！<br>
          表情・深掘りへの対応力など、<br>
          ESだけではわからない<br>
          情報を読み取ることができます。<br>
          <a href="https://storyset.com/work">Work illustrations by Storyset</a>
        </div>
        <div class="right-child">
          <img src="{{ asset('/img/top/illustration/Bookmarks-rafiki.svg') }}" alt="採点＆フィードバック">
         
        </div>
      </div>
    </div>
    <div class="features-content-wrapper hover-action">
      <span>02</span>
      <h2>人事による採点機能！</h2>
      <div class="features-content flex">
        <div class="features-content-description left-child">
          ロジカル・バイタリティなどの<br>
          細かい採点項目により、<br>
          自社が求める能力を持った学生を<br>
          簡単に探すことができます。<br>
          <a href="https://storyset.com/work">Work illustrations by Storyset</a>
        </div>
        <div class="right-child">
          <img src="{{ asset('/img/top/illustration/Development focus-amico.svg') }}" alt="採点＆フィードバック">
        </div>
      </div>
    </div>
    <div class="features-content-wrapper hover-action">
      <span>03</span>
      <h2>学生へのオファー！</h2>
      <div class="features-content flex">
        <div class="features-content-description left-child">
          全国の能動的な23卒の学生に<br>
          オファーを出せます。<br>
          地方学生も多く抱えているため、<br>
          全国的な母集団形成も可能です。<br>
          <a href="https://storyset.com/work">Work illustrations by Storyset</a>
        </div>
        <div class="right-child">
          <img src="{{ asset('/img/top/illustration/Agreement-amico.svg') }}" alt="オファー">
        </div>
      </div>
    </div>
  </div>
</div>

<div class="outline-wrapper">
  <img class="outline-upper-background" src="{{ asset('/img/top/outline-upper.jpeg') }}" alt="サービス概要上部の背景画像">
  <div class="outline-logo">
    <img class="outline-logo" src="{{ asset('/img/logo/logo_white.png') }}" alt="ロゴ">
  </div>
  <div class="outline-description">
    面接図鑑 は「面接って楽しい」を、<br>
    スタンダードにしていくサービスです。
  </div>
  <div class="outline-achievement-wrapper">
    <div class="flex-pc">
      <div class="outline-achievement">
        <div class="outline-achievement-title">コンテンツ数</div>
        <div class="outline-achievement-value">{{ $contentsNumber }}本</div>
      </div>
      <div class="outline-achievement">
        <div class="outline-achievement-title">満足度</div>
        <div class="outline-achievement-value">95.6％</div>
      </div>
    </div>
    <span class="outline-achievement-comment">※β版実績</span>
  </div>
  <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/568076489?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;" title="面接図鑑 サービス紹介動画"></iframe></div><script src="https://player.vimeo.com/api/player.js"></script>
  <img class="outline-under-background" src="{{ asset('/img/top/outline-bottom.png') }}" alt="サービス概要下部の背景画像">
</div>

<a name="contact"></a>
<div class="audience-step">
  <script src="https://sdk.form.run/js/v2/embed.js"></script>
  <div
    class="formrun-embed"
    data-formrun-form="@yuu-yoshida--1630127771"
    data-formrun-redirect="false">
  </div>
  <div class="w-block"></div>
</div>

<div class="footer">
  <div class="flex">
    <h2><a href="{{ route('policy') }}"><span>利用規約</span></a></h2>
    <h2><a href="{{ route('policy') }}"><span>プライバシーポリシー</span></a></h2>
  </div>
    Copyright © 2021 株式会社ぱむ Inc.All rights reserved
</div>
<script type="text/javascript" src="{{ asset('/js/top.js') }}"></script>
@endsection
