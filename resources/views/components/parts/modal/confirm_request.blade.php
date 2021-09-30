<link href="{{ asset('css/components/parts/modal/com_confirm_request.css') }}" rel="stylesheet" type="text/css">
@if(isset($isRequest) && $isRequest > 0)
  <div class="request-notification-wrapper popup" id="js-popup">
    <div class="popup-inner">
      <div class="close-btn" id="js-close-btn"></div>
      <h2 class="font-gradient">新着「面接申し込み」のお知らせ</h2>
      <img src="{{ asset('img/search-hr.svg') }}" alt="リクエストの確認">
      <p>
        学生から「面接申し込み」が届きました。
        <br><br>
        画面下の<b>
          <span class="pc">「面接申し込みの確認」</span>
          <span class="sp" >「申込確認」</span>
        </b>より、面接申し込みを確認してください。
        <br><br>
        ※ 申し込みを見送る場合でも、<b>「見送る」</b>を選択し送信してください。
      </p>
    </div>
    <div class="black-background" id="js-black-bg"></div>
  </div>
  <script type="text/javascript" src="{{ asset('/js/components/parts/modal/confirm_request.js') }}"></script>
@endif