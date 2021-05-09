@extends('layouts.hr.common')
@section('content')
<div class="container" onload>
  <h1>面接採点を開始する。</h1>
  <div>
    面接採点は必ず、面接終了後に行ってください。<br>
    面接中は以下のボタンから、質問シートを印刷して得点＆レビューをメモしてください。
  </div>
  <form method="post" action="{{ route('hr.interview.scoring.post') }}">
    @csrf

    <hr>

    <div class="d-grid gap-3">
      @foreach($questionArray as $question)
        <div>
          質問{{ $loop->iteration }}：{{$interview->$question->name}}
        </div>
        <div class="range">
          <input type="range" name="question-{{ $loop->iteration }}" min="0" max="100" step="5" value="50">
          <span>50</span>
        </div>
        <textarea name="review-{{ $loop->iteration }}" rows="10" cols="60" placeholder="ここに記入してください"></textarea>

      @endforeach
    </div>

    <div class="next-button">
      <input type="hidden" name="interview_id" value="{{ $interview->id }}">
      <input class="btn btn-primary" type="submit" value=" → " />
    </div>
  </form>
</div>
<script type="text/javascript">
  let interview = @json($interview);
</script>
<script src="{{ asset('/js/hr/interview/scoring/form.js') }}"></script>
@endsection
