@extends('layouts.common_top')
@section('content')
<div class="firstview-wrapper">
  <img src="{{ asset('/img/logo/logo_origin.png') }}" alt="ロゴ">
  <div class="">
    <P>
      現役人事が採点した<br>
      就活生の面接が見放題！
    </p>
    <p>
      他の就活生は、いったいどんな面接をしているの？<br>
      あらゆる業界の人事・学生の面接が得点付きで見放題！<br>
      自身が面接を受けると、企業からのオファーも貰えます！<br>
    </p>
  </div>
  <img class="pc-img" src="./img/firstview-pc.png" alt="PCイラスト">
  <div class="firstview-register-wrapper">
    <span>たった3分で完了！</span>
    <div class="firstview-register-button">
      まずは会員登録する
    </div>
    <span>ログインはこちら</span>
  </div>
</div>

<div class="bottom-fixed-button">
  <li class="nav-item">
    <a class="nav-link" href="{{ route('register.choice') }}">新規会員登録</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('login') }}">ログイン</a>
  </li>
</div>

<div class="features-wrapper">
  <h1>面接図鑑の特徴</h1>
  <div class="features-content">
    <span>01</span>
    <h2>全ての面接が見放題！</h2>
    <div class="features-content-description">
      苦手なあの質問、<br>
      みんなはどう答えてるの？<br>
      ○○業界の面接傾向は？<br>
      検索機能を活用して、<br>
      気になる疑問を解消しよう。<br>
    </div>
    <img src="./img/features-content-illustration-1.png" alt="全ての面接が見放題！">
  </div>
  <div class="features-content">
    <span>02</span>
    <h2>現役人事による採点！</h2>
    <div class="features-content-description">
      採点を担当するのは、<br>
      全員現役の人事。<br>
      フィードバック付きの<br>
      採点だから、<br>
      面接力UP間違いなし！<br>
    </div>
    <img src="./img/features-content-illustration-1.png" alt="仮置き">
  </div>
  <div class="features-content">
    <span>03</span>
    <h2>企業からのオファー！</h2>
    <div class="features-content-description">
      自身も面接を受けて<br>
      動画投稿すれば、<br>
      日本全国の企業から<br>
      『1次面接免除以上』の<br>
      特別オファーが届く！<br>
    </div>
    <img src="./img/features-content-illustration-1.png" alt="仮置き">
  </div>
</div>

<div class="outline-wrapper">
  <h1>サービス概要</h1>
  <div class="outline-description">
    面接図鑑 は「面接って楽しい」を、<br>
    スタンダードにしていくサービスです。
  </div>
  <div class="outline-achievement-wrapper">
    <div class="outline-achievement">
      <div class="outline-achievement-title"></div>
      <div class="outline-achievement-value"></div>
    </div>
    <div class="outline-achievement">
      <div class="outline-achievement-title">96.2%</div>
      <div class="outline-achievement-value">5000本</div>
      <span>以上</span>
    </div>
    <span>β版実績</span>
  </div>
  <iframe width="560" height="315" src="https://www.youtube.com/embed/qXdmMn600N8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>

<div class="plan-wrapper">
  <h1>プランの説明</h1>
  <div class="plan">
    <h2>投稿者プラン</h2>
    <img src="./img/temporary-plan.png" alt="仮置き">
    <div class="plan-description">
      <ul>
        <li>
          サービス内で人事と面接すると、その動画が得点付きでアップロードされる。
          <span>※顔を隠すなど、プライバシー保護は徹底いたします。</span>
        </li>
        <li>動画を見た企業から、1次面接免除以上の特別オファーを貰うことができる。</li>
        <li>月額0円で、他の人の面接が見放題。</li>
      </ul>
    </div>
  </div>
  <div class="plan">
    <h1>プランの説明</h1>
    <h2>視聴者プラン</h2>
    <img src="./img/temporary-plan.png" alt="仮置き">
    <div class="plan-description">
      <ul>
        <li>月額料金を支払うことで、学生の面接が見放題。</li>
      </ul>
    </div>
  </div>
</div>

<div class="contributor-wrapper">
  <h1>視聴者プランの詳細</h1>
  <div class="contributor-step">
    <h2>STEP1</h2>
    <h3>面接官を選んで日程調整</h3>
    <div class="contributor-content-wrapper">
      <div class="contributor-content-description">
        業界を指定し、<br>
        人事を検索可能。<br>
        人事マイページを参照して、<br>
        面接をしたい人事を選択し、<br>
        日程を調整する。<br>
      </div>
      <img src="./img/features-content-illustration-1.png" alt="仮置き">
    </div>
  </div>
  <div class="contributor-step">
    <h2>STEP2</h2>
    <h3>面接＆フィードバック</h3>
    <div class="contributor-content-wrapper">
      <img src="./img/features-content-illustration-1.png" alt="仮置き">
      <div class="contributor-content-description">
        ｢Zoom｣を用いて、<br>
        人事と面接する。<br>
        人事が選定した頻出質問と、<br>
        質問への深掘りが行われ、<br>
        終了後は質問ごとに<br>
        採点とフィードバックがある。<br>
      </div>
    </div>
  </div>
  <div class="contributor-step">
    <h2>STEP3</h2>
    <h3>動画をサービス内にアップロード</h3>
    <div class="contributor-content-wrapper">
      <div class="contributor-content-description">
        動画を閲覧した企業から、<br>
        気になった学生に<br>
        オファーが届く。<br>
        オファーを承認すると、<br>
        最低でも一次面接免除が<br>
        確約された特別フローで<br>
        選考に招待される。<br>
      </div>
      <img src="./img/features-content-illustration-1.png" alt="仮置き">
    </div>
  </div>
  <div class="contributor-step">
    <h2>STEP4</h2>
    <h3>面接官を選んで日程調整</h3>
    <div class="contributor-content-wrapper">
      <img src="./img/features-content-illustration-1.png" alt="仮置き">
      <div class="contributor-content-description">
        動画を閲覧した企業から、<br>
        気になった学生に<br>
        オファーが届く。<br>
        オファーを承認すると、<br>
        最低でも一次面接免除が<br>
        確約された特別フローで<br>
        選考に招待される。<br>
      </div>
    </div>
  </div>
</div>

<div class="audience-wrapper">
  <h1>投稿者プランの詳細</h1>
  <div class="audience-step">
    <h2>STEP1</h2>
    <h3>面接官を選んで日程調整</h3>
    <div class="audience-content-wrapper">
      <div class="audience-content-description">
        ｢ガクチカ｣、｢自己PR｣、<br>
        ｢あなたの強み｣など、<br>
        面接での頻出質問を網羅。<br>
        その中から自分が<br>
        気になった質問を検索できる。<br>
      </div>
      <img src="./img/features-content-illustration-1.png" alt="仮置き">
    </div>
  </div>
  <div class="audience-step">
    <h2>STEP2</h2>
    <h3>面接官を選んで日程調整</h3>
    <div class="audience-content-wrapper">
      <img src="./img/features-content-illustration-1.png" alt="仮置き">
      <div class="audience-content-description">
        動画では、他の学生が<br>
        どのような受け答えを<br>
        しているのか知ると共に、<br>
        オンライン面接における<br>
        間のとり方や適切な言葉遣い<br>
        などを学ぶことができる。<br>
      </div>
    </div>
  </div>
  <div class="audience-step">
    <h2>STEP3</h2>
    <h3>面接官を選んで日程調整</h3>
    <div class="audience-content-wrapper">
      <div class="audience-content-description">
        面接官の採点やFBも<br>
        参照できるため、<br>
        どんな回答が、<br>
        どの業界の人事に<br>
        評価されやすいか<br>
        知ることができる。<br>
      </div>
      <img src="./img/features-content-illustration-1.png" alt="仮置き">
    </div>
  </div>
</div>

<div class="cost-wrapper">
  <h1>利用料金</h1>
  <img src="./img/temporary-plan.png" alt="仮置き">
  <div>※注意事項があればここに注意事項を書きます。</div>
  <div class="cost-promotion">
    <span>投稿者プランなら</span>
    <span>月額<span>0</span>円</span>
  </div>
</div>

<div class="promotion-wrapper">
  <h1>新規会員登録はここから</h1>
  <div class="promotion-wrapper">
    <span>たった3分で完了！</span>
    <div class="promotion-button">
      まずは会員登録する
    </div>
  </div>
</div>
@endsection
