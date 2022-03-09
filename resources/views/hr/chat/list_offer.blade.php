@section('title', 'マッチングした学生リスト')
<link rel="stylesheet" href="{{ asset('css/st/chat/list.css') }}">
@extends('layouts.hr.nofooter')
@section('content')

<div class="tabs">
  <input id="all" type="radio" name="tab_item" checked>
  <label class="tab_item" for="all">オファーした学生</label>
  <input id="offer" type="radio" name="tab_item">
  <label class="tab_item" for="offer">辞退or見送り</label>
  <div class="tab_content" id="all_content">
    <div class="mark-discription">
      <div class="slow-reply"></div>
      <div>：１週間以上返信がない場合に表示。</div>
    </div>
    <div class="container">
      @if(isset($offerCollection[0]))
        @foreach($offerCollection as $chat)
          <div class="hr-profile-wrapper">
            <div class="flex">
              <a href="{{ route('hr.stpage', $chat['id']) }}" class="left-child">
                <img class="hr-photo" src="{{ asset($chat['imagePath']) }}" alt="プロフィール写真">
              </a>
              <a href="{{ route('hr.interview.chat.talk', $chat['id']) }}" class="right-child">
                <div class="chat-name">
                  {{ $chat['name'] }}（{{ $chat['university'] }}）
                </div>
                <div class="chat-under-flex">
                  <div class="chat-body-wrapper">
                    <span class="chat-body">{{ $chat['latestMessage'] }}</span>
                  </div>
                  <div class="unread-flag-wrapper">
                    @if($chat['unread'] != 0)
                      <div>{{ $chat['unread'] }}</div>
                    @endif
                    @if($chat['slowReply'] == TRUE)
                      <div class="slow-reply"></div>
                    @endif
                  </div>
                </div>
              </a>
            </div>
          </div>
        @endforeach
      @else
        <div class="none-block">
          <h1>オファーした学生がいません</h1>
          <div class="description">
            「オファーする学生を探す」より、オファーする学生を探してオファーしてください。<br>
            またマイページの企業情報を充実させておくと、オファー承諾率がアップします。<br>
          </div>
        </div>

        <a href="{{ route('hr.offer.search') }}">
          <div class="button">
            <span>オファーする学生を探す</span>
          </div>
        </a>
      @endif
    </div>
  </div>
  <div class="tab_content" id="offer_content">
    <div class="container">
    @if(isset($rejectOfferCollection[0]))
        @foreach($rejectOfferCollection as $chat)
          <div class="hr-profile-wrapper">
            <div class="flex">
              <a href="{{ route('hr.stpage', $chat['id']) }}" class="left-child">
                <img class="hr-photo" src="{{ asset($chat['imagePath']) }}" alt="プロフィール写真">
              </a>
              <a href="{{ route('hr.interview.chat.talk', $chat['id']) }}" class="right-child">
                <div class="chat-name">
                  {{ $chat['name'] }}（{{ $chat['university'] }}）
                </div>
                <div class="chat-under-flex">
                  <div class="chat-body-wrapper">
                    <span class="chat-body">{{ $chat['latestMessage'] }}</span>
                  </div>
                  <div class="unread-flag-wrapper">
                    @if($chat['unread'] != 0)
                      <div>{{ $chat['unread'] }}</div>
                    @endif
                    @if($chat['slowReply'] == TRUE)
                      <div class="slow-reply"></div>
                    @endif
                  </div>
                </div>
              </a>
            </div>
          </div>
        @endforeach
      @else
          <div class="none-block">
            <h1>辞退or見送りした学生はいません</h1>
            <div class="description">
              まだ、オファーを送っていない場合は、<br>
              「オファーする学生を探す」より、オファーする学生を探してオファーしてください。<br>
            </div>
          </div>
          <a href="{{ route('hr.offer.search') }}">
            <div class="button">
              <span>オファーする学生を探す</span>
            </div>
          </a>
        @endif
      </div>
    </div>
  </div>

<script type="text/javascript" src="{{ asset('/js/st/chat/list.js') }}"></script>
@endsection
