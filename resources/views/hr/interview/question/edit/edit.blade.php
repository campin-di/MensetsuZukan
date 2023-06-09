@section('title', '質問リストの変更')
<link rel="stylesheet" href="{{ asset('css/hr/interview/question/edit/edit.css') }}">
@extends('layouts.hr.reverse')
@section('content')

<div class="top-content-wrapper">
  <div class="top-content">
    <h1>質問シートを変更する。</h1>
  </div>
</div>

<div class="container add-wrapper">
  <form method="post" action="{{ route('hr.interview.question.post') }}">
    @csrf

    <div class="question-wrapper">
      @for($index = 1; $index <= 3; $index++)
      <div class="question">
        <select name="question-{{$index}}" required>
          @foreach($questions as $question)
            @if($question->name == $alreadyQuestionArray[$index-1])
            <option value="{{$question->name}}" selected>{{$question->name}}</option>
            @endif
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
