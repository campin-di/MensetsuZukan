<div class="container">
  <div>
    {{ $st->nickname }}さんから面接リクエストがありました。
  </div>
  <br>
  <div>
    候補日時：{{ $mailDateArray['date'] }}：
    @foreach($mailDateArray['time'] as $time)
      {{ $time }}, 
    @endforeach
  </div>
  <br>
  面接図鑑にログインいただき、「マイページ」→下のバー「面接リクエストを確認する」から面接日を選択してください！<br>
  <br>
  https://mensetsu-zukan.online/hr/login
  <br>
  ※ 何か不明な点があった場合は、下記問い合わせ窓口までお問い合わせください。
  <br>
  ================<br>
  【発行元】<br>
  面接図鑑 運営<br>
  <br>
  【お問い合わせ用メールアドレス】<br>
  mensetsuzukan@pampam.co.jp<br>
  本メールに掲載された内容を許可なく転載することを禁じます。<br>
  ================<br>
</div>
