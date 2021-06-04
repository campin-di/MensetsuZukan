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
        <select name="question-{{$index}}" required>
          <option value="">質問{{ $index }}</option>
          @foreach($questions as $question)
            <option value="{{$question->name}}">{{$question->name}}</option>
          @endforeach
        </select>
      </div>
      @endfor
    </div>

    <input type="hidden" name="interview_id" value="{{ $id }}">
    @include('components.parts.button.form.next_button')
  </form>
</div>

@endsection
