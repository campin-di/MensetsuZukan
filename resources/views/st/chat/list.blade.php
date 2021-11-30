@section('title', '面接官を探す')
<link rel="stylesheet" href="{{ asset('css/st/chat/list.css') }}">
@extends('layouts.st.nofooter')
@section('content')

<div class="tabs">
  <input id="all" type="radio" name="tab_item" checked>
  <label class="tab_item" for="all">面接官</label>
  <input id="offer" type="radio" name="tab_item">
  <label class="tab_item" for="offer">オファーされた企業</label>
  <div class="tab_content" id="all_content">
    <div class="container">
      @if(isset($chatCollection[0]))
        @foreach($chatCollection as $chat)
          <div class="hr-profile-wrapper">
            <div class="flex">
              <a href="{{ route('hrpage', $chat['id']) }}" class="left-child">
                <img class="hr-photo" src="{{ asset($chat['imagePath']) }}" alt="プロフィール写真">
              </a>
              <a href="{{ route('interview.chat.talk', $chat['id']) }}" class="right-child">
                <div class="chat-name">{{ $chat['nickname'] }}</div>
                <div class="chat-under-flex">
                  <div class="chat-body-wrapepr">
                    <span class="chat-body">
                      {{ $chat['latestMessage'] }}
                    </span>
                  </div>
                  <div class="unread-flag-wrapper">
                    @if($chat['unread'] != 0)
                      <div>{{ $chat['unread'] }}</div>
                    @endif
                  </div>
                </div>
              </a>
            </div>
          </div>
        @endforeach
      @else
        <div class="none-block">
          <h1>人事とマッチングしていません</h1>
          <div class="description">
            まずは、「面接練習」から面接して欲しい人事に面接リクエストを送信しましょう。<br>
            プロフィールを充実させておくと、承諾率がアップします！<br>
          </div>
          <a href="{{ route('interview.search') }}">
            <div class="button">
              <span>面接練習</span>
            </div>
          </a>
        </div>
      @endif
    </div>
  </div>

  <div class="tab_content" id="offer_content">
    <div class="container">
      @if(isset($offerCollection[0]))
        @foreach($offerCollection as $chat)
          <div class="hr-profile-wrapper">
            <div class="flex">
              <a href="{{ route('hrpage', $chat['id']) }}" class="left-child">
                <img class="hr-photo" src="{{ asset($chat['imagePath']) }}" alt="プロフィール写真">
              </a>
              <a href="{{ route('interview.chat.talk', $chat['id']) }}" class="right-child">
                <div class="chat-name">{{ $chat['nickname'] }}</div>
                <div class="chat-under-flex">
                  <div class="chat-body-wrapepr">
                    <span class="chat-body">
                      {{ $chat['latestMessage'] }}
                    </span>
                  </div>
                  <div class="unread-flag-wrapper">
                    @if($chat['unread'] != 0)
                      <div>{{ $chat['unread'] }}</div>
                    @endif
                  </div>
                </div>
              </a>
            </div>
          </div>
        @endforeach
      @else
        <div class="none-block">
          <h1>人事とマッチングしていません</h1>
          <div class="description">
            まずは「面接練習」をしてオファーをもらいましょう。<br>
            プロフィールを充実させておくと、さらにオファー率がアップします！<br>
          </div>
          <a href="{{ route('interview.search') }}">
            <div class="button"><span>面接練習</span></div>
          </a>
        </div>
      @endif
    </div>
  </div>
</div>
<script type="text/javascript" src="{{ asset('/js/st/chat/list.js') }}"></script>
@endsection
