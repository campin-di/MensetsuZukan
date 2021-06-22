@extends('layouts.hr.common')
<link rel="stylesheet" href="{{ asset('css/hr/interview/scoring/form.css') }}">
@section('content')

<div class="top-content-wrapper">
  <div class="top-content">
    <h1>面接採点を開始する。</h1>
  </div>
</div>

<div class="container" onload>
  <div class="description">
    採点は必ず、面接終了後に行ってください。<br>
    面接中は以下のボタンから、質問シートを印刷して得点＆レビューをメモしてください。
  </div>

  <form method="post" action="{{ route('hr.interview.scoring.post') }}">
    @csrf


    <div class="form-wrapper">
    @for($index = 1; $index <= 3; $index++)
      <div class="content">
        <div class="question">
          <select name="question-{{$index}}" required>
            <option value="">質問{{ $index }}</option>
            @foreach($questions as $question)
              <option value="{{$question->name}}">{{$question->name}}</option>
            @endforeach
          </select>  
        </div>

        <div class="score pc-flex">
          <div>
            <span>地頭</span>
            <div class="radios">
              @for($i = 1; $i <= 5; $i++)
                <label for="logic{{$index}}-{{$i}}"></label>
                @if($i == 3)
                  <input id="logic{{$index}}-{{$i}}" name="logic{{$index}}" type="radio" value="{{$i}}" checked>
                @else
                  <input id="logic{{$index}}-{{$i}}" name="logic{{$index}}" type="radio" value="{{$i}}">
                @endif
              @endfor
              <span id="logic-slider{{$index}}" class="slide"></span>
            </div>
          </div>
          <div>
            <span>人柄</spna>
            <div class="radios">
              @for($i = 1; $i <= 5; $i++)
                <label for="personality{{$index}}-{{$i}}"></label>
                @if($i == 3)
                  <input id="personality{{$index}}-{{$i}}" name="personality{{$index}}" type="radio" value="{{$i}}" checked>
                @else
                 <input id="personality{{$index}}-{{$i}}" name="personality{{$index}}" type="radio" value="{{$i}}">
                @endif
              @endfor
              <span id="personality-slider{{$index}}" class="slide"></span>
            </div>
          </div>
        </div>

        <textarea name="review-{{ $index }}" placeholder="ここにレビューを書いてください。" required></textarea>
      </div>
      @endfor
    </div>

    <input type="hidden" name="interview_id" value="{{ $id }}">
    @include('components.parts.button.form.next_button')
  </form>
</div>
<script type="text/javascript">
    let zoomUrl = @json($zoomUrl);
  </script>
<script type="text/javascript" src="{{ asset('/js/hr/interview/scoring/form.js') }}"></script>

@endsection
