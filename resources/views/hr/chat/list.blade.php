@section('title', 'マッチングした学生リスト')
<link rel="stylesheet" href="{{ asset('css/st/chat/list.css') }}">
@extends('layouts.hr.nofooter')
@section('content')

<div class="tabs">
  <input id="all" type="radio" name="tab_item" checked>
  <label class="tab_item" for="all">面接する学生</label>
  <input id="offer" type="radio" name="tab_item">
  <label class="tab_item" for="offer">オファーした学生</label>
  <div class="tab_content" id="all_content">
    <div class="container">
      @if(isset($chatCollection[0]))
        @foreach($chatCollection as $chat)
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
                  </div>
                </div>
              </a>
            </div>
          </div>
        @endforeach
      @else
        <div class="none-block">
          <h1>学生とマッチングしていません</h1>
          <div class="description">
            学生から面接申し込みがあるまでお待ちください。<br>
            またプロフィールを充実させておくと、申し込み率がアップします！<br>
          </div>
        </div>

        <a href="{{ route('hr.mypage') }}">
          <div class="button">
            <span>マイページ</span>
          </div>
        </a>
      @endif
    </div>
  </div>
  <div class="tab_content" id="offer_content">
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
                    </div>
                  </div>
                </a>
              </div>
            </div>
          @endforeach
        @else
          <div class="none-block">
            <h1>学生とマッチングしていません</h1>
            <div class="description">
              学生から面接申し込みがあるまでお待ちください。<br>
              またプロフィールを充実させておくと、申し込み率がアップします！<br>
            </div>
          </div>

          <a href="{{ route('hr.mypage') }}">
            <div class="button">
              <span>マイページ</span>
            </div>
          </a>
        @endif
      </div>
    </div>
  </div>



<script type="text/javascript" src="{{ asset('/js/st/chat/list.js') }}"></script>
@endsection
