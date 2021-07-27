@section('title', '利用規約＆プライバシーポリシー')
<link rel="stylesheet" href="{{ asset('css/st/policy.css') }}">
@extends('layouts.st.common')
@section('content')
<div class="main">
  <div class="main-inbox">
    <div class="tab-wrap">
        <input id="TAB-01" type="radio" name="TAB" class="tab-switch" checked="checked" />
        <label class="tab-label" for="TAB-01"><h1>利用規約</h1></label>
        <div class="tab-content">
          <h2>第1条：（面接図鑑）</h2>
          <ol type="1" class="list-box">
            <li>｢面接図鑑｣とは、株式会社ぱむ（以下「当社」という）が提供するインターネット上における面接採点及び面接シェアサービス（以下「本アプリ」という）をいいます。なお、本アプリに付随するメール配信、コミュニティなどの就職支援サービス、他本アプリ会員を対象とした各種サービス（以下総称して「本サービス」という）を提供致します。</li>
          </ol>

          <h2>第2条：（会員）</h2>
          <ol type="1" class="list-box">
          <li>「法人会員」とは、本サービスの利用を申し込む、採用活動を行う法人の人事担当者をいいます。</li>
          <li>本サービスの利用申し込む法人会員は、本規約に承諾の上、当社が指定する方法にて当社が本サービス提供にあたり必要となる情報（以下、「登録情報」といいます。）を当社に提供することで本サービスを利用することができることとします。</li>
          <li>「学生会員」とは、本サービスの利用を申し込む就職活動を行う学生をいいます。</li>
          <li>本サービスの利用を申し込む学生会員は、本規約に承諾の上、当社が指定する方法にて本アプリ上に、個人を特定できる項目（以下「個人情報」という）および就職志向、資格、経験、属性などの就職活動のために必要な情報（以下「活動情報」という）を登録することで本サービスを利用することができることとします。</li>
          </ol>

          <h2>第3条：（契約の成立）</h2>
          <ol type="1" class="list-box">
            <li>本契約は、法人会員の場合は、本規約に承諾の上、利用申込書を当社に提出し、当社が本サービスの提供を開始した時点をもって成立するものとします。</li>
            <li>本契約は、学生会員の場合は、本規約に承諾の上、本アプリ上にて登録し、当社が本サービスの提供を開始した時点をもって成立するものとします。</li>
            <li>当社が前二項いずれかの申込みの後に異議を述べた場合には、本契約は申込み時点に遡及して無効となります。</li>
            <li>本規約について、特段の定めがある場合には、法人会員の場合は利用申込書に記載した内容が、学生会員の場合は当社より通知した内容が本規約に優先するものとします。</li>
            <li>法人会員が本契約期間中において追加オプションを契約する場合には、改めて利用申込書を当社に提出し、当社が承諾した時点をもって本契約に追加（以下、「契約追加」といいます。）されるものとします。契約追加の内容は、当社が請求する本サービス料金に反映されます。</li>
            <li>法人会員及び学生会員は、本規約に承諾して本サービスを利用する必要があり、法人会員は利用申込書を発行した時点で、学生会員は登録をした時点で本規約の内容をすべて承諾しているものとみなします。</li>  
          </ol>

          <h2>第4条：（本サービスの内容）</h2>
          <ol type="1" class="list-box">
            <li>当社は、面接動画の制作、編集、面接動画の投稿及び削除、その他本サービスに付随する管理をおこなうこととします。</li>
            <li>法人会員は、学生会員へのスカウト、をおこなうこととします。なお、当社が別途認めた法人会員に関しては、学生会員へのスカウトに加えて、（面接の動画撮影、面接の動画形式の変換、学生会員との面接日程の調整をおこなうことができることとします。</li>
            <li>学生会員は、面接動画の視聴、面接動画の撮影被写体、面接対応、企業との面接日程の調整をおこなうこととします。</li>
          </ol>

          <h2>第5条：（本サービスの提供）</h2>
          <ol type="1" class="list-box">
            <li>当社は、法人会員及び学生会員が当社に対し提出した情報を元に本サービスを提供します。登録情報が誤っている等の理由により本サービスの提供ができない場合には、登録情報の削除をおこないます。当該削除により本サービスの提供と受けられないとしても当社はその責任を負いません。なお、その場合であっても、本サービス料金は発生します。</li>
            <li>学生会員は、登録にあたっては偽りない情報を登録し、登録した個人情報および活動情報その他の情報に対し、自らがその内容に関する責任を負うものとします。なお、学生会員は、本アプリの会員専用ページにおいて、会員登録時に登録した個人情報や活動情報を修正、削除、追加することができます。</li>
            <li>法人会員及び学生会員は、本サービス利用時に公開した面接動画を削除したい場合は、当社まで連絡することとします。</li>
          </ol>

          <h2>第6条：（会員サービスの変更など）</h2>
          <ol type="1" class="list-box">
            <li>
              次の各号の一に該当する場合、当社は、法人会員及び学生会員への予告なしに、本サービスの全部又は一部を停止することができるものとし、これに起因して法人会員及び学生会員又は第三者に発生した損害につき、当社は、何ら責任を負わないものとします。
              <ol type="a" class="list-box">
                <li>定期的又は緊急に、本サービスを提供するためのシステムの保守又は点検を行う場合（第三者提供サービスの仕様変更に伴う場合を含みます。）</li>
                <li>火災、停電、天災地変等の非常事態により、本サービスの提供が困難又は不能となった場合</li>
                <li>戦争、内乱、暴動、騒擾、労働争議等により、本サービスの提供が困難又は不能となった場合</li>
                <li>本サービスの提供のためのシステムの不良、第三者からの不正アクセス、コンピュータウイルスの感染等により、本サービスの提供が困難又は不能であると当社が判断した場合</li>
                <li>法令等に基づく措置により、本サービスの提供が困難又は不能であると当社が判断した場合</li>
                <li>第三者提供サービスの停止又は終了（保守、仕様の変更、瑕疵の修補による停止を含みますが、これらに限りません。）により、本サービスの提供が困難又は不能であると当社が判断した場合</li>
                <li>その他当社がやむを得ないと判断した場合</li>
              </ol>
            </li>
            <li>前項にかかわらず、当社は、本サービスの全部又は一部を法人会員及び学生会員への相当期間を定めての事前予告を条件として、いつでも、改訂、追加、変更又は廃止することができるものとし、これに起因して法人会員及び学生会員又は第三者に発生した損害につき、当社は、一切、賠償責任を負わないものとします。</li>
            <li>本サービスについて、本条第1項に定める停止もしくはその他の支障が生じた場合又はそのおそれがある場合には、当社は、法人会員及び学生会員に対し、直ちにその旨を連絡するものとします。</li>
          </ol>

          <h2>第7条：（会員の禁止行為）</h2>
          <ol type="1" class="list-box">
            <li>
              法人会員及び学生会員は、本サービスを利用するにあたり、次の各号の一に該当する行為又はそのおそれのある行為をしてはならないものとします。
              <ol type="a" class="list-box">
                <li>犯罪行為又は犯罪行為に結びつく行為、もしくは公序良俗に反する行為</li>
                <li>虚偽の情報または他人名義にて登録をする行為</li>
                <li>他人になりすまして、本サービスを利用する行為</li>
                <li>他の会員、第三者又は当社の著作権、知的所有権を侵害する行為</li>
                <li>他の会員、第三者又は当社の財産、プライバシーを侵害する行為</li>
                <li>他の会員、第三者又は当社を誹謗中傷する行為</li>
                <li>他の会員、第三者又は当社に不利益を与える行為</li>
                <li>営利目的で本サービスを利用する行為</li>
                <li>本サービスと競合するサービスの開発・改善のために本サービスを利用する行為</li>
                <li>本サービス提供のためのシステムへ不正アクセスをする行為</li>
                <li>本サービスのネットワーク又はシステム等に過度な負荷をかける行為</li>
                <li>本アプリコンテンツの全部又は一部を、当社に無断で、複製、複写、転載、転送、蓄積、販売、出版、その他会員の利用の範囲を超えて利用する行為</li>
                <li>本サービスの利用権を第三者に再許諾、譲渡し、又は担保に供する行為</li>
                <li>本アプリのリバースエンジニアリング、逆コンパイル、逆アセンブル、その他これらに準じる行為</li>
                <li>ソフトウェア・ウイルスまたはコンピュータ・ソフトウェア、ハードウェア若しくは通信機器の機能を妨害、破壊、制限するコンピュータ・コード、ファイル、プログラムを含む素材をアップロード、投稿または送信する行為</li>
              </ol>
            </li>
          </ol>

          <h2>第8条：（責任・保証の否認）</h2>
          <ol type="1" class="list-box">
            <li>当社は、本サービスの利用により発生した法人会員及び学生会員、又は第三者が被った損害すべてに対し、いかなる責任も負わないものとし、一切の損害賠償をする責任を負わないものとします。</li>
            <li>当社は、法人会員及び学生会員が本サービスを利用することにより第三者との間で生じた紛争、または第三者に対して損害を生じさせた場合、自己の責任においてそれを解決するものとし、当社は一切責任を負わないものとします。</li>
            <li>法人会員及び学生会員は、自己の作為又は不作為を原因として生じた当社の責務、損害又は費用（弁護士費用を含みますが、これに限られません。）に関しては、当社に対して補償し、当社を免責するものとします。</li>
            <li>本サービスにおいて提供されるすべての情報（法人会員の属する企業の採用情報、学生会員に対する面接に関するアドバイス等。以下「提供情報」という）は法人会員及び学生会員自らの責任で提供されるものであり、提供情報の内容に関しては、当社は一切の保証しないこととします。</li>
            <li>
              当社は、本アプリ含む本サービスを、現状有姿の状態で提供します。当社は、法人会員及び学生会員に対し、次の各号の点につき、いかなる保証も行うものではありません。
              <ol type="1" class="list-box">
                <li>本サービスの利用に起因して利用環境に不具合や障害が生じないこと</li>
                <li>本サービスの最新性、正確性、完全性、永続性、目的適合性、有用性</li>
              </ol>
            </li>
          </ol>

          <h2>第9条：（情報の利用目的）</h2>
          <ol type="1" class="list-box">
            <li>当社は、法人会員及び学生会員が当社に対して提供した情報を、本サービスの提供のために利用致します。また、本サービスの提供の一環として、当社で運営している就職支援、イベント情報のメールマガジンを送信するために利用致します。</li>
          </ol>

          <h2>第10条：（知的財産権等）</h2>
          <ol type="1" class="list-box">
            <li>本サービスに関する一切の特許権、実用新案権、意匠権、商標権、著作権、不正競争防止法上の権利、及びその他一切の財産的又は人格的権利（以下、「知的財産権等」といいます。）は、すべて当社に帰属します。</li>
            <li>法人会員及び学生会員が、本サービスに関連して提供する資料及び情報等（当社が本サービスの一環として制作・編集した上で法人会員及び学生会員に提供するコンテンツを含みます。）に関する著作権を含む知的財産権、所有権その他一切の権利は、当該資料又は情報等を提供した当事者に帰属し、留保されます。</li>
            <li>当社は、法人会員及び学生会員に対し、本規約の遵守を条件として、本サービスを通じて提供されるコンテンツについて、非独占的に利用する権利を許諾します。法人会員及び学生会員は、譲渡、転売及び営利目的での利用、その他の二次的利用はおこなってはならないものとします。</li>
            <li>法人会員及び学生会員が本規約及びその他の利用条件に反する使用をした場合には、当社は、その自由な裁量により、予告なく当該利用許諾を取り消すことができるものとします。</li>
            <li>当社は、法人会員及び学生会員が本アプリ内に自ら投稿した意見や情報などの内容の全部または一部を掲載する場合は、事前に当事者の承諾を得て、インターネット上に転載することができることとします。その場合の転載内容の著作権は全て当社に帰属するものとします。</li>
            <li>当社は、登録された情報を基に、個人を特定できない形式にて統計データを作成し、これを何ら制限なく利用できるものとします。</li>
          </ol>

          <h2>第11条：（会員の脱会・除名）</h2>
          <ol type="1" class="list-box">
            <li>法人会員は、契約期間満了の1ヶ月前までに当社指定の方法に従い解約の申し出をおこなうこととし、当社が解約について承諾した時点で解約したものとします。</li>
            <li>学生会員は、本アプリ内より退会ができるものとし、学生会員が個人設定より退会申請をおこない、申請が完了した時点で退会したものとします。</li>
            <li>法人会員、学生会員、または当社が、本規約のいずれかの規定に違反した場合には、相手方は、書面により、当該違反を直ちに是正するよう請求できるものとします。</li>
            <li>当該書面の受領後2週間を経過しても当該違反が治癒されない場合には、相手方は直ちに本契約を解除することができます。</li>
            <li>ただし、重大な契約違反について治癒が不可能であると合理的に判断される場合には、相手方は、何ら催告を要せず、本契約を直ちに解除することができるものとします。</li>
          </ol>

          <h2>第12条：（個人情報の管理）</h2>
          <ol type="1" class="list-box">
            <li>
            法人会員、学生会員、および当社は、相手方の事前の承諾なしに、本サービスの利用に関して相手方から開示された情報（以下、「機密情報」といいます。）を、複写、複製、破壊、改竄、第三者への開示及び漏洩をせず、また本規約に定める目的以外での利用を行わないものとします。ただし、次の各号の一に該当する情報は機密情報に該当しないものとします。
            <ol type="1" class="list-box">
              <li>相手方から開示された時点で、公知である情報</li>
              <li>相手方から開示された後、自己の責によらず公知となった情報</li>
              <li>第三者から、機密保持義務を負うことなく合法的に入手した情報</li>
              <li>相手方から開示された情報によることなく独自に開発した情報</li>
            </ol>
            </li>
            <li>学生会員が、自らの意思により特定の企業に対して自己の個人情報を開示した場合、本アプリ上に登録した情報より当該本人が特定できる場合は、当社は機密に保持する義務を負わないこととします。</li>
            <li>当社は、国その他の公権力により適法に機密情報の開示を命令された場合、本条第1項の定めにかかわらず、当該公権力に対して当該機密情報を開示できるものとします。</li>
            <li>当社は、本サービスに関する自己の業務の全部又は一部を、第三者に再委託することができるものとし、法人会員及び学生会員は予め承諾するものとします。その場合、当社は、本条と同等の機密保持義務を当該第三者に負わせるものとします。</li>
          </ol>

          <h2>第13条：（有料会員の決済手続き及び解約・返金）</h2>
          <ol type="1" class="list-box">
            <li>法人会員は、申込書の内容に準じ、本サービスに関する料金を支払うこととします。</li>
            <li>法人会員が本サービスを通じて学生会員にスカウトを行い、当該学生会員が法人会員へ内定承諾した場合に手数料が発生する、成功報酬形式と致します。但し、第4条第2項にて定めた当社が別途認めた法人会員に関しては、無償にて本サービスを利用できることとします。</li>
            <li>前項の場合、法人会員は、当社に対し当該学生会員より内定承諾があった日から5営業日以内に当社へ通知することとします。</li>
            <li>当社は、当社に支払われた本サービスに関する料金を理由の如何を問わず返金しないものとします。</li>
          </ol>

          <h2>第14条：（会員規約の変更）</h2>
          <ol type="1" class="list-box">
            <li>当社は法人会員及び学生会員の了承を得ることなく、本規約を随時変更、追加、削除することができます。</li>
          </ol>

          <h2>第15条：（合意管轄）</h2>
          <ol type="1" class="list-box">
            <li>本規約は日本法を準拠法とし、本規約に関わる一切の紛争については、東京地方裁判所または東京簡易裁判所を専属的合意管轄裁判所とします。</li>
          </ol>

          <h2>第16条：（協議）</h2>
          <ol type="1" class="list-box">
            <li>本サービスに関してお客様と当社との間で問題が生じた場合、お客様と当社は、誠意をもって協議し、その解決に努めるものとします。</li>
          </ol>
          <div>
            2021年7月1日制定
          </div>

        </div>
        <input id="TAB-02" type="radio" name="TAB" class="tab-switch" />
        <label class="tab-label" for="TAB-02"><h1>プライバシーポリシー</h1></label>
        <div class="tab-content">
          <h2>プライバシーポリシー</h2>

          プライバシーポリシーについては、<a href="https://www.pampam.co.jp/privacy/">こちら</a>をご覧ください。<br><br>

        <h2>＜本方針に関するお問合せ先＞</h2>

        面接図鑑 運営事務局 
        <div class="email-box">
        mensetsu-zukan@pampam.co.jp
        </div>

        </div>
        <input id="TAB-03" type="radio" name="TAB" class="tab-switch" />
        <label class="tab-label" for="TAB-03"><h1>お問い合わせ</h1></label>
        <div class="tab-content">
          ＜ 面接図鑑 運営事務局 ＞ 
          <div class="email-box">
          mensetsu-zukan@pampam.co.jp
          </div>
        </div>
    </div>
  </div>
</div>
@endsection
