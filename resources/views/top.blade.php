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
      <span class="firstview-register-upper">無料＆3分で完了！</span>
      <a href="{{ route('register.choice') }}">
        <div class="firstview-register-button updown-btn">
          まずは会員登録する
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
    <div class="features-content-wrapper hover-action">
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
    <div class="features-content-wrapper hover-action">
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

<div class="contributor-wrapper">
  <h1>面接の実施方法</h1>
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
  <h1>面接の視聴方法</h1>
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
  <span class="cost-title-upper">COST</span>
  <h1>利用料金</h1>
  <img class="cost-table-img" src="./img/top/price.jpg" alt="仮置き">
</div>

<div class="outline-wrapper">
  <img class="outline-upper-background" src="{{ asset('/img/top/outline-upper.jpeg') }}" alt="サービス概要上部の背景画像">
  <div class="outline-logo">
    <h1>コンテンツはどんな感じ？</h1>
  </div>
  <div class="outline-description contents-detail">
    面接図鑑には全国の就活生が行った<br>面接動画が公開されています。
  </div>
  <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/581707645?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;" title="面接図鑑 サービス紹介動画"></iframe></div><script src="https://player.vimeo.com/api/player.js"></script>
  <img class="outline-under-background" src="{{ asset('/img/top/outline-bottom.png') }}" alt="サービス概要下部の背景画像">
</div>

<div class="audience-wrapper">
  <h1 class="qanda-title pc"><a name="qanda">よくある質問</a></h1>
  <section class="container">
    <div class="qanda-wrapper">
      <div class="qanda-content">
        <div class="cp_qa">
          <div class="cp_actab">
            <input id="cp_tabfour01" type="checkbox" name="tabs">
            <label for="cp_tabfour01">どのような内容が質問されますか？</label>
            <div class="cp_actab-content">いわゆる頻出質問と呼ばれるものを3問ほど出題します。解答に対しては、人事が自由に深堀を行います。</div>
          </div>
          <div class="cp_actab">
            <input id="cp_tabfour02" type="checkbox" name="tabs">
            <label for="cp_tabfour02">顔・氏名など個人情報が公開されたくありません。</label>
            <div class="cp_actab-content">動画は匿名・モザイク付きで公開されます。モザイクなしの動画を見ることができるのは、サービスに登録した人事のみとなります。</div>
          </div>
          <div class="cp_actab">
            <input id="cp_tabfour03" type="checkbox" name="tabs">
            <label for="cp_tabfour03">面接官の企業名は事前に知ることができますか？</label>
            <div class="cp_actab-content">人事の企業名は基本的に非公開となっています。人事から学生にオファーが来た時点で、その学生にのみ企業情報が開示されます。</div>
          </div>
          <div class="cp_actab">
            <input id="cp_tabfour04" type="checkbox" name="tabs">
            <label for="cp_tabfour04">人事の方は本当の人事ですか？経験は豊富ですか？</label>
            <div class="cp_actab-content">業界は様々ですが、面接官を行う方々は実際に企業で人事経験を積んでいます。また、こちらで作成したマニュアルに基づいて面接を行うため、一定の面接レベルは保証されます。</div>
          </div>
          <div class="cp_actab">
            <input id="cp_tabfour05" type="checkbox" name="tabs">
            <label for="cp_tabfour05">志望理由は用意しておかないといけませんか？</label>
            <div class="cp_actab-content">特定の企業を想定した面接ではないため、企業への志望理由は必要ありません。しかし、現時点で一番志望している業界とその理由は問われることがあります。</div>
          </div>
          <div class="cp_actab">
            <input id="cp_tabfour06" type="checkbox" name="tabs">
            <label for="cp_tabfour06">相手企業の「求める人材」を知ることはできますか？</label>
            <div class="cp_actab-content">特定の企業を想定した面接ではないので、企業に受かるためではなく、自分の魅力を最大限に伝えるという意識で望んでいただければと思います。</div>
          </div>
          <div class="cp_actab">
            <input id="cp_tabfour07" type="checkbox" name="tabs">
            <label for="cp_tabfour07">企業の業界・規模などによってどのように自分を表現し分けたらいいですか？</label>
            <div class="cp_actab-content">あなたらしさを素直に表現していただければと思います。しかし、普段面接ごとにキャラを使い分けているのであれば、どのキャラが最も受けがいいか採点機能を利用して検証するのも面白いかもしれません。</div>
          </div>
          <div class="cp_actab">
            <input id="cp_tabfour08" type="checkbox" name="tabs">
            <label for="cp_tabfour08">どの内容を軸として話せば評価されやすいですか？</label>
            <div class="cp_actab-content">何度も面接を受けることができるので試行錯誤してみることをオススメします！ただし、相手企業によって答えが変わるような質問はなるべく避けるようにいたします。</div>
          </div>
          <div class="cp_actab">
            <input id="cp_tabfour09" type="checkbox" name="tabs">
            <label for="cp_tabfour09">誤って個人を特定できる発言をしてしまった場合は？</label>
            <div class="cp_actab-content">公開前の動画は一度運営がチェックしており、個人が特定される恐れがある発言はカットしています。もしご自身の発言内容に不安があれば、運営までお問い合わせください。</div>
          </div>
          <div class="cp_actab">
            <input id="cp_tabfour10" type="checkbox" name="tabs">
            <label for="cp_tabfour10">面接はスーツで受けなければなりませんか？</label>
            <div class="cp_actab-content">スーツでなくても大丈夫です。あなたらしさを一番伝えられる服装でお越しください。</div>
          </div>
          <div class="cp_actab">
            <input id="cp_tabfour11" type="checkbox" name="tabs">
            <label for="cp_tabfour11">面接中に回線が悪くなった場合は？</label>
            <div class="cp_actab-content">一度通信が安定するまでお待ちいただき、通信環境が改善されましたら再開します。再開の目途が立たない場合は後日面接を再設定となりますので、できるだけ通信環境を整えてご参加ください。</div>
          </div>
          <div class="cp_actab">
            <input id="cp_tabfour12" type="checkbox" name="tabs">
            <label for="cp_tabfour12">PC内蔵のスピーカーやマイクで面接を受けても大丈夫ですか？</label>
            <div class="cp_actab-content">ハウリング・片方の音声しか録音されないといった問題がございますので、可能な限りマイク付きイヤホンでのご参加をお願いいたします。</div>
          </div>
          <div class="cp_actab">
            <input id="cp_tabfour13" type="checkbox" name="tabs">
            <label for="cp_tabfour13">面接中の水分補給は？</label>
            <div class="cp_actab-content">熱中症を避けるための水分補給は行ってください。ただし、実際のオンライン面接を想定しておりますので、選考中の振る舞いが評価に影響するかどうかは担当の面接官に依存します。</div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<div class="promotion-wrapper">
  <h1>新規会員登録はここから</h1>
  <div class="promotion">
    <span>無料＆3分で完了！</span>
    <a href="{{ route('register.choice') }}">
      <div class="promotion-button updown-btn">
        まずは会員登録する
      </div>
    </a>
  </div>
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
