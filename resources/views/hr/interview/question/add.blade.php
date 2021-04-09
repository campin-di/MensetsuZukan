@extends('layouts.common_hr')
@section('content')

<div class="container">
  <h1>質問リストを作成する。</h1>
  <div>
    面接当日は、今回作成した質問の順に面接を行ってください。<br>
    各質問に対する深ぼり質問はしてもらって構いません。<br>
    質問内容は面接を受けるまで、学生には公開されません。
  </div>
  <form method="post" action="{{ route('hr.interview.question.post') }}">
    @csrf

    <div class="d-grid gap-3">
      @for($index = 1; $index <= 6; $index++)
      <div>
        <select name="question-{{$index}}" class="form-select" required>
          <option value="">質問{{ $index }}</option>
          @foreach($questions as $question)
            <option value="{{$question->name}}">{{$question->name}}</option>
          @endforeach
        </select>
      </div>
      @endfor
    </div>

    <div class="next-button">
      <input type="hidden" name="interview_id" value="{{ $id }}">
      <input class="btn btn-primary" type="submit" value=" → " />
    </div>
  </form>
</div>
@endsection
