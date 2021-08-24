@section('title', '面接予約完了')
<link href="{{ asset('/css/st/auth/registerd.css') }}" rel="stylesheet">
@extends('layouts.st.reverse')
@section('content')

@if($flag == 1)
  @include('components.parts.page_title_reverse', ['title'=>'面接リクエストの送信完了'])
  <div class="container form-wrapper">
    <div class="card">
      <div class="title">公式LINEを追加してください！</div>
      <p>
        面接図鑑「公式LINE」の友だち追加が完了していない方は、下のボタンから追加してください。<br><br>
        面接リクエストが受諾された場合、公式LINEから通知されますので必ず追加をお願いします。<br><br>
        オファーなどの連絡は公式LINEを通して行われますので、ブロックしないようにしてください。
      </p>
      <a href="https://lin.ee/Fgn5e1O">
        <img class="line-add-img" src="https://scdn.line-apps.com/n/line_add_friends/btn/ja.png" alt="友だち追加">
      </a>
    </div>

    @include('components.parts.button.form.complete_button', ['upperRoute' => '/', 'upperText'=>'トップページに戻る', 'underRoute' => 'interview.search', 'underText' => '他の日程もリクエストする', 'var' => ''])
  </div>
@else
  @include('components.parts.page_title_reverse', ['title'=>'候補日程が重複しました'])
  <div class="container form-wrapper">
    <p>
      入力された面接候補日程は、すでに別の面接リクエストとして登録済みであるもしくは、他の就活生によって既に面接予約が行われています。<br><br>
      別の日程を再び入力いただくか、「他の日程もリクエストする」→「面接リクエストを確認・変更する」から過去の面接候補日を変更してください。
    </p>
    @include('components.parts.button.form.complete_button', ['upperRoute' => '/', 'upperText'=>'トップページに戻る', 'underRoute' => 'interview.search', 'underText' => '他の日程もリクエストする', 'var' => ''])
  </div>
@endif
@endsection

