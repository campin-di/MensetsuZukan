@section('title', 'マッチングした学生リスト')
<link rel="stylesheet" href="{{ asset('css/st/chat/list.css') }}">
@extends('layouts.hr.nofooter')
@section('content')

@include('components.parts.page_title', ['title'=>'新着メッセージ'])

<div class="container">
  @if(isset($chatCollection[0]))
    @foreach($chatCollection as $chat)
      <div class="hr-profile-wrapper">
        <div class="flex">
          <a href="{{ route('hr.stpage', $chat['id']) }}" class="left-child">
            <img class="hr-photo" src="{{ asset($chat['imagePath']) }}" alt="プロフィール写真">
          </a>
          <a href="{{ route('hr.interview.chat.talk', $chat['id']) }}" class="right-child">
            <div class="chat-name">{{ $chat['nickname'] }}</div>
            <div class="chat-body">{{ $chat['latestMessage'] }}</div>
          </a>
        </div>
      </div>
    @endforeach
  @else
    <div class="none-block">
      <h1>学生とマッチングしていません</h1>
      <div class="none-img">
        <img src="{{ asset('img/unavailable/unavailable-contributor.svg')}}" alt="面接官を探しているイラスト">
      </div>
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

<script type="text/javascript" src="{{ asset('/js/st/chat/list.js') }}"></script>
@endsection
