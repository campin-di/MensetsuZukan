@extends('layouts.common_top')
@section('content')
<div class="firstview-wrapper">
  <div class="firstview-content">
    <div class="flex-pc">
      <div class="left-child-pc">
        <img class="firstview-logo" src="{{ asset('/img/logo/logo_white.png') }}" alt="ロゴ">
        <P class="firstview-main-msg">
          現役人事が採点した<br>
          就活生の面接が見放題！
        </p>
        <p class="firstview-sub-msg">
          他の就活生は、いったいどんな面接をしているの？<br>
          様々な業界の人事・学生の面接が得点付きで見放題！<br>
          面接を受けると、企業からのオファーも貰える！<br>
        </p>
      </div>
      <div class="right-child-pc">
        <img class="firstview-pc-img" src="./img/top/firstview-pc.svg" alt="PCイラスト">
      </div>
    </div>
    <div class="firstview-register-wrapper">
      <span class="firstview-register-upper">たった3分で完了！</span>
      <a href="{{ route('register.choice') }}">
        <div class="firstview-register-button">
          まずは会員登録する
        </div>
      </a>
    </div>
  </div>
</div>

<div class="bottom-fixed-button">
  <li class="bottom-button-left">
    <a href="{{ route('register.choice') }}">新規会員登録</a>
  </li>
  <li class="bottom-button-right">
    <a href="{{ route('login') }}">ログイン</a>
</div>

<div class="features-wrapper">
  <h1>面接図鑑の特徴</h1>
  <div class="flex-pc">
    <div class="features-content-wrapper">
      <span>01</span>
      <h2>全ての面接が見放題！</h2>
      <div class="features-content flex">
        <div class="features-content-description left-child">
          苦手なあの質問、<br>
          みんなはどう答えてるの？<br>
          ○○業界の面接傾向は？<br>
          検索機能を活用して、<br>
          気になる疑問を解消しよう。<br>
          <a href="https://storyset.com/work">Work illustrations by Storyset</a>
        </div>
        <div class="right-child">
          <img src="{{ asset('/img/top/illustration/Bookmarks-rafiki.svg') }}" alt="採点＆フィードバック">
         
        </div>
      </div>
    </div>
    <div class="features-content-wrapper">
      <span>02</span>
      <h2>現役人事による採点！</h2>
      <div class="features-content flex">
        <div class="features-content-description left-child">
          採点を担当するのは、<br>
          全員現役の人事。<br>
          フィードバック付きの<br>
          採点結果を見られるので、<br>
          面接力UP間違いなし！<br>
          <a href="https://storyset.com/work">Work illustrations by Storyset</a>
        </div>
        <div class="right-child">
          <img src="{{ asset('/img/top/illustration/Development focus-amico.svg') }}" alt="採点＆フィードバック">
        </div>
      </div>
    </div>
    <div class="features-content-wrapper">
      <span>03</span>
      <h2>企業からのオファー！</h2>
      <div class="features-content flex">
        <div class="features-content-description left-child">
          サービス内で面接を受けて<br>
          動画投稿するだけで、<br>
          日本全国の企業から<br>
          『1次面接免除以上』の<br>
          特別オファーが届く！<br>
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
  <img class="outline-upper-background" src="{{ asset('/img/top/outline-upper.png') }}" alt="仮置き">
  <div class="outline-logo">
    <img class="outline-logo" src="{{ asset('/img/logo/logo_white.png') }}" alt="ロゴ">
  </div>
  <div class="center">
    <h1>サービス概要</h1>
  </div>
  <div class="outline-description">
    面接図鑑 は「面接って楽しい」を、<br>
    スタンダードにしていくサービスです。
  </div>
  <div class="outline-achievement-wrapper">
    <div class="flex-pc">
      <div class="outline-achievement">
        <div class="outline-achievement-title">満足度</div>
        <div class="outline-achievement-value">96.2％</div>
      </div>
      <div class="outline-achievement">
        <div class="outline-achievement-title">コンテンツ数</div>
        <div class="outline-achievement-value">5000本</div>
        <span>以上</span>
      </div>
    </div>
    <span class="outline-achievement-comment">※β版実績</span>
  </div>
  <div class="center outline-iframe-wrapper">
    <iframe class="outline-iframe" src="https://www.youtube.com/embed/qXdmMn600N8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  </div>
  <img class="outline-under-background" src="{{ asset('/img/top/outline-bottom.png') }}" alt="仮置き">
</div>

<div class="plan-wrapper">
  <h1>プランの説明</h1>
  <div class="plan">
    <h2>投稿者プラン</h2>
    <div class="flex-pc">
      <div class="center left-child-pc">
        <img src="{{ asset('/img/top/illustration/Interview-amico.svg') }}" alt="面接">
      </div>
      <div class="plan-description right-child-pc">
        <ol>
          <li>
            サービス内で人事と面接すると、<br>
            その面接動画が得点付きでアップされる。
            <div>※顔を隠すなど、プライバシー保護は徹底いたします。</div>
          </li>
          <li>
            動画を見た企業から、1次面接免除以上の<br>
            特別オファーを貰うことができる。
          </li>
          <li>月額0円で、他の人の面接が見放題。</li>
          <a href="https://storyset.com/work" style="color: #EEE;font-size: 10px;">Work illustrations by Storyset</a>
        </ol>
      </div>
    </div>
  </div>
  <div class="plan">
    <h2>視聴者プラン</h2>
    <div class="flex-pc">
      <div class="center left-child-pc">
        <img src="{{ asset('/img/top/illustration/Bookmarks-rafiki.svg') }}" alt="見放題">
      </div>
      <div class="plan-description right-child-pc">
        <ol>
          <li>月額料金を支払うと、学生の面接が見放題。</li>
          <a href="https://storyset.com/work" style="color: #EEE;font-size: 10px;">Work illustrations by Storyset</a>
        </ol>
      </div>
    </div>
  </div>
</div>

<div class="contributor-wrapper">
  <h1>投稿者プランの詳細</h1>
  <div class="contributor-step">
    <div class="center contributor-title-left">
      <h2>STEP1</h2>
      <h3>面接官を選んで日程調整</h3>
    </div>
    <div class="contributor-content-wrapper flex">
      <div class="contributor-content-description left-child">
        業界を指定し、<br>
        人事を検索可能。<br>
        人事マイページを参照して、<br>
        面接をしたい人事を選択し、<br>
        日程を調整する。<br>
        <a href="https://storyset.com/work" style="color: #EEE;font-size: 10px;">Work illustrations by Storyset</a>
      </div>
      <div class="right-child">
        <img src="{{ asset('/img/top/illustration/calendar-rafiki.svg') }}" alt="日程調整">
      </div>
    </div>
  </div>

  <div class="contributor-step">
    <div class="center contributor-title-right">
      <h2>STEP2</h2>
      <h3>面接＆フィードバック</h3>
    </div>
    <div class="contributor-content-wrapper flex">
      <div class="contributor-content-description left-child flex-reverse-1">
        ｢Zoom｣を用いて、<br>
        人事と面接する。<br>
        人事が選定した頻出質問と、<br>
        質問への深掘りが行われ、<br>
        終了後は質問ごとに<br>
        採点･フィｰドバックがある。<br>
        <a href="https://storyset.com/work" style="color: #EEE;font-size: 10px;">Work illustrations by Storyset</a>
      </div>
      <div class="right-child flex-reverse-2">
      <img src="{{ asset('/img/top/illustration/Interview-pana.svg') }}" alt="面接＆フィードバック">
      </div>
    </div>
  </div>

  <div class="contributor-step">
    <div class="center contributor-title-left">
      <h2>STEP3</h2>
      <h3>動画をサービス内にアップロード</h3>
    </div>
    <div class="contributor-content-wrapper flex">
      <div class="contributor-content-description left-child">
        オンライン面接の動画は、<br>
        サービス内で公開される。<br>
        サービス利用学生には、<br>
        モザイク処理で個人が<br>
        特定できない状態に<br>
        加工した動画が公開される。<br>
        <a href="https://storyset.com/work" style="color: #EEE;font-size: 10px;">Work illustrations by Storyset</a>
      </div>
      <div class="right-child">
        <img src="{{ asset('/img/top/illustration/upload-pana.svg') }}" alt="動画のアップロード">
      </div>
    </div>
  </div>

  <div class="contributor-step">
    <div class="center contributor-title-right">
      <h2>STEP4</h2>
      <h3>1次面接免除の特別オファー</h3>
    </div>
    <div class="contributor-content-wrapper flex">
      <div class="contributor-content-description left-child flex-reverse-1">
        動画を閲覧した企業から、<br>
        オファーが届く。<br>
        オファーを承認すると、<br>
        最低でも一次面接免除が<br>
        確約された特別フローで<br>
        選考に招待される。<br>
        <a href="https://storyset.com/work" style="color: #EEE;font-size: 10px;">Work illustrations by Storyset</a>
      </div>
      <div class="right-child flex-reverse-2">
        <img src="{{ asset('/img/top/illustration/messages-rafiki.svg') }}" alt="特別オファー">
      </div>
    </div>
  </div>
</div>

<div class="audience-wrapper">
  <h1>視聴者プランの詳細</h1>
  <div class="audience-step">
    <div class="center contributor-title-left">
      <h2>STEP1</h2>
      <h3>気になる質問を検索</h3>
    </div>
    <div class="audience-content-wrapper flex">
      <div class="audience-content-description left-child">
        ｢ガクチカ｣、｢自己PR｣、<br>
        ｢あなたの強み｣など、<br>
        面接での頻出質問を網羅。<br>
        その中から自分が<br>
        気になった質問を検索できる。<br>
        <a href="https://storyset.com/work" style="color: #EEE;font-size: 10px;">Work illustrations by Storyset</a>
      </div>
      <div class="right-child">
        <img src="{{ asset('/img/top/illustration/select-amico.svg') }}" alt="質問の検索">
      </div>
    </div>
  </div>

  <div class="audience-step">
    <div class="center contributor-title-right">
      <h2>STEP2</h2>
      <h3>動画を選択し、視聴</h3>
    </div>
    <div class="audience-content-wrapper flex">
      <div class="audience-content-description left-child flex-reverse-1">
        動画では、他の学生が<br>
        どのような受け答えを<br>
        しているのか知ると共に、<br>
        オンライン面接における<br>
        間のとり方や適切な言葉遣い<br>
        などを学ぶことができる。<br>
        <a href="https://storyset.com/work" style="color: #EEE;font-size: 10px;">Work illustrations by Storyset</a>
      </div>
      <div class="right-child flex-reverse-2">
        <img src="{{ asset('/img/top/illustration/files-amico.svg') }}" alt="動画の選択・視聴">
      </div>
    </div>
  </div>

  <div class="audience-step">
    <div class="center contributor-title-left">
      <h2>STEP3</h2>
      <h3>人事からの採点・FBも見られる</h3>
    </div>
    <div class="audience-content-wrapper flex">
      <div class="audience-content-description left-child">
        面接官からの採点やFBを<br>
        見ることができるので、<br>
        どのように答えたら、<br>
        人事に良い評価をもらえるか<br>
        知ることができる。<br>
        <a href="https://storyset.com/work" style="color: #EEE;font-size: 10px;">Work illustrations by Storyset</a>
      </div>
      <div class="right-child">
      <img src="{{ asset('/img/top/illustration/survey-amico.svg') }}" alt="採点・フィードバック">
      </div>
    </div>
  </div>
</div>

<div class="cost-wrapper">
  <img class="cost-wrapper-img" src="./img/top/cost-upper.png" alt="仮置き">
  <span class="cost-title-upper">COST</span>
  <h1>利用料金</h1>
  <img class="cost-table-img" src="./img/top/price.jpg" alt="仮置き">
  <div class="cost-img-description">※注意事項があればここに注意事項を書きます。</div>
  <div class="cost-promotion flex">
    <div>投稿者プランなら</div>
    <div class="cost-promotion-price">月額<span>0</span>円</div>
  </div>
  <img class="cost-wrapper-img" src="./img/top/cost-bottom.png" alt="仮置き">
</div>

<div class="promotion-wrapper">
  <h1>新規会員登録はここから</h1>
  <div class="promotion">
    <span>たった3分で完了！</span>
    <a href="{{ route('register.choice') }}">
      <div class="promotion-button">
        まずは会員登録する
      </div>
    </a>
  </div>
</div>

<div class="footer">
  <div class="flex">
    <a href="#">利用規約</a>
    <a href="#">プライバシーポリシー</a>
  </div>
    Copyright © 2021 株式会社ぱむ Inc.All rights reserved
</div>
@endsection
