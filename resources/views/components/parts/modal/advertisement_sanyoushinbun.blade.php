<link href="{{ asset('css/components/parts/modal/com_confirm_request.css') }}" rel="stylesheet" type="text/css">
@if(isset($practiceFlag) && $practiceFlag == TRUE)
  <div class="request-notification-wrapper popup" id="js-popup">
    <div class="popup-inner">
      <div class="close-btn" id="js-close-btn"></div>
      <h2 class="font-gradient">イベントのお知らせ！</h2>
      <img src="{{ asset('img/advertisement/sanyoushinbun_ad.jpg') }}" alt="山陽新聞社の就活イベント">
      <p>
        <br>
        2月16日（水）は山陽新聞就活DASH主催の［働き方から見る企業研究ガイダンス］の開催日！
        <br><br>
        企業約60社と対面で会えるチャンス！ぜひ参加してみよう！イベントの詳細・予約申し込みは<a href="https://www.shukatsu.jp/2023/event/detail?event_id=2700">こちら</a>より！
      </p>
    </div>
    <div class="black-background" id="js-black-bg"></div>
  </div>
  <script type="text/javascript" src="{{ asset('/js/components/parts/modal/confirm_request.js') }}"></script>
@endif