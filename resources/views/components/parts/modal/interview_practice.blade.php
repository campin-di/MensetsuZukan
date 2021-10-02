<link href="{{ asset('css/components/parts/modal/com_confirm_request.css') }}" rel="stylesheet" type="text/css">
@if(isset($practiceFlag) && $practiceFlag == TRUE)
  <div class="request-notification-wrapper popup" id="js-popup">
    <div class="popup-inner">
      <div class="close-btn" id="js-close-btn"></div>
      <h2 class="font-gradient">模擬面接に挑戦しよう！</h2>
      <img src="{{ asset('img/search-hr.svg') }}" alt="リクエストの確認">
      <p>
        <br>
        画面下の<b>
          <span class="pc">「面接練習にチャレンジ」</span>
          <span class="sp" >「面接練習」</span>
        </b>から、面接申し込みをしてみましょう。
        <br><br>
        模擬面接を行うと<b>「評価の内訳」</b>が閲覧できるようになります！
      </p>
    </div>
    <div class="black-background" id="js-black-bg"></div>
  </div>
  <script type="text/javascript" src="{{ asset('/js/components/parts/modal/confirm_request.js') }}"></script>
@endif