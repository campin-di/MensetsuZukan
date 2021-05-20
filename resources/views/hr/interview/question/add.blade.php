@extends('layouts.hr.reverse')
<link rel="stylesheet" href="{{ asset('css/hr/interview/question/add.css') }}">
@section('content')

<div class="top-content-wrapper">
  <div class="top-content">
    <h1>質問リストを作成する。</h1>
  </div>
</div>

<div class="container add-wrapper">
  <form method="post" action="{{ route('hr.interview.question.post') }}">
    @csrf

    <div class="question-wrapper">
      @for($index = 1; $index <= 3; $index++)
      <div class="question">
        <select name="question-{{$index}}" class="" required>
          <option value="">質問{{ $index }}</option>
          @foreach($questions as $question)
            <option value="{{$question->name}}">{{$question->name}}</option>
          @endforeach
        </select>
      </div>
      @endfor
    </div>

    <div class="attention-wrapper">
      <ul class="attention">
        <li>面接当日は、上記の質問順に面接を行ってください。</li>
        <li>各質問に対する深ぼり質問はしてもらって構いません。</li>
        <li>質問は当日まで学生に公開されません。</li>
      </ul>
    </div>

    <input type="hidden" name="interview_id" value="{{ $id }}">
    <div class="button-wrapper">
      <button type="submit">
        →
      </button>
    </div>
  </form>
</div>

@endsection
