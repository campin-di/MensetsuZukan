<link href="{{ asset('css/components/parts/modal/com_confirm_request.css') }}" rel="stylesheet" type="text/css">
@if(isset($flag) && $flag > 0)
  <div class="request-notification-wrapper popup" id="js-popup">
    <div class="popup-inner">
      <div class="close-btn" id="js-close-btn"></div>
      <h2>新着面接リクエストのお知らせ</h2>
      <img src="{{ asset('img/search-hr.svg') }}" alt="リクエストの確認">
      <p>
        学生から面接リクエストが届きました。<br><br>
        
        画面右下の<b>
          <span class="pc">「面接リクエストの確認」</span>
          <span class="sp">「面接確認」</span>
        </b>より、面接リクエストを確認してください。<br><br>
        ※ 日程が合わない場合でも、<b>「日程が埋まっている」</b>を選択し送信してください。
      </p>
    </div>
    <div class="black-background" id="js-black-bg"></div>
  </div>
  <script type="text/javascript" src="{{ asset('/js/components/parts/modal/confirm_request.js') }}"></script>
@endif