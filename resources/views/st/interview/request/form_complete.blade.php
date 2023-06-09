@section('title', '面接予約完了')
<link rel="stylesheet" href="{{ asset('css/st/interview/request/form_complete.css') }}">
@extends('layouts.st.reverse')
@section('content')

@if($flag == FALSE)
  @include('components.parts.page_title_reverse', ['title'=>'模擬面接の申し込み完了'])
  <div class="container form-wrapper">
    @if($lineFlag)
      <div class="card">
        <div class="title">(重要)公式LINEの追加</div>
        <p>
        デジマ面接図鑑「公式LINE」の友だち追加が完了していない方は、下のボタンから追加してください。<br><br>
          面接リクエストが受諾された場合、公式LINEから通知されますので必ず追加をお願いします。<br><br>
          オファーなどの連絡は公式LINEを通して行われますので、ブロックしないようにしてください。
        </p>
        <a href="https://lin.ee/Fgn5e1O">
          <img class="line-add-img" src="https://scdn.line-apps.com/n/line_add_friends/btn/ja.png" alt="友だち追加">
        </a>
      </div>
    @else
      <div class="card">
          <div class="title">承諾率をUPさせるには？</div>
          <p>
            マイページ情報を充実させると、面接申込の承諾率がアップします！<br><br>
            「マイページ」より、プロフィール情報を充実させましょう！
          </p>
        </div>
    @endif

    @include('components.parts.button.form.complete_button', ['upperRoute' => '/', 'upperText'=>'トップページに戻る', 'underRoute' => 'interview.search', 'underText' => '他の人事にも申し込む', 'var' => ''])
  </div>
@else
  @include('components.parts.page_title_reverse', ['title'=>'既に申し込んでいます'])
  <div class="container form-wrapper">
    <div class="none-block">
      <div class="none-img">
        <img src="{{ asset('img/illustration/wait.svg')}}">
        </div>
        <div class="description">
          人事が申し込みを承諾するまでお待ちください。<br><br>
          プロフィールを充実させると、申し込みの承諾率がアップします！<br>
          「マイページ」より、プロフィール情報を充実させましょう！
        </div>
      </div>
      @include('components.parts.button.form.complete_button', ['upperRoute' => '/', 'upperText'=>'トップページに戻る', 'underRoute' => 'interview.search', 'underText' => '他の人事にも申し込む', 'var' => ''])
    </div>
  </div>
@endif
@endsection

