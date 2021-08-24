@section('title', '面接可能日の追加')
<link rel="stylesheet" href="{{ asset('css/st/interview/schedule/check.css') }}">
@extends('layouts.st.common')
@section('content')

@include('components.parts.page_title', ['title'=>'面接可能な日程の確認＆変更'])

<div class="container">
  
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
</div>

<script type="text/javascript" src="{{ asset('/js/hr/interview/schedule/check.js') }}"></script>
@endsection
