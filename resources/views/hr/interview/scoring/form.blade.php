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
      @foreach($questionArray as $question)
      <div class="content">
        <div class="question-title">
          質問{{ $loop->iteration }}：{{$interview->$question->name}}
          <input type="hidden" name="question-{{ $loop->iteration }}-name" value="{{$interview->$question->name}}">
        </div>
        <div class="range">
          <input type="range" name="question-{{ $loop->iteration }}" min="0" max="100" step="5" value="50">
          <span>50</span>点
        </div>
        <textarea name="review-{{ $loop->iteration }}" placeholder="ここにレビューを書いてください。"></textarea>
      </div>
      @endforeach
    </div>
    <input type="hidden" name="interview_id" value="{{ $interview->id }}">
    @include('components.parts.button.form.next_button')
  </form>
</div>
<script type="text/javascript">
  let interview = @json($interview);
</script>
<script src="{{ asset('/js/hr/interview/scoring/form.js') }}"></script>
@endsection
