@section('title', '面接可能日の追加')
<link rel="stylesheet" href="{{ asset('css/st/interview/schedule/check.css') }}">
@extends('layouts.st.common')
@section('content')

@include('components.parts.page_title', ['title'=>'面接可能な日程の確認＆変更'])

<div class="container">
  
  @if(!empty($scheduleArray))
  <form method="post" class="form" action="{{ route('interview.schedule.delete') }}">
    @csrf
    <div>
      面接可能日程を削除したい場合は、日程を選択の上次のページにお進みください。
    </div>

    <div class="container_detail description">
    @foreach($scheduleArray as $date => $schedule)
      <div class="item">
        <input id="acd-check{{$loop->iteration}}" class="acd-check" type="checkbox">
        <label class="acd-label" for="acd-check{{$loop->iteration}}">{{$date}}</label>
        <div class="acd-content">
          @php $cnt = $loop->iteration; @endphp
          @foreach($schedule as $key => $time)
            <div class="inputGroup">
              <input id="option{{ $cnt }}{{ $loop->iteration }}" name="schedule[]" type="checkbox" value="{{$date}}:{{ $key }}" class="check">
              <label for="option{{ $cnt }}{{ $loop->iteration }}">{{ $time }}</label>
            </div>
            @php $cnt++; @endphp
          @endforeach
        </div>
      </div>
    @endforeach
  </div>

    @include('components.parts.button.form.next_button')
  </form>
  @else 
    <div class="none-img">
      <img src="{{ asset('img/unavailable/unavailable-contributor.svg')}}" alt="面接官を探しているイラスト">
      <a href="https://storyset.com/work" style="color: #EEE;font-size: 10px;">Work illustrations by Storyset</a>        
    </div>
    <div class="description">
      面接リクエストはまだ送信されていません。<br>
      下のボタンから面接相手を見つけ、面接リクエストを送ってみましょう！<br>
    </div>
    @include('components.parts.button.transition_button', ['routeName'=>'interview.search', 'var'=>'', 'text'=>'現役人事と面接練習！'])

  @endif
</div>

<script type="text/javascript" src="{{ asset('/js/hr/interview/schedule/check.js') }}"></script>
@endsection
