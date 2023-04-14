@section('title', '質問リストの確認')
<link rel="stylesheet" href="{{ asset('css/hr/interview/question/form_confirm.css') }}">
@extends('layouts.hr.reverse')
@section('content')

<div class="top-content-wrapper">
  <div class="top-content">
    <h1>確認</h1>
  </div>
</div>

<div class="container add-wrapper">
	<form method="post" action="{{ route('hr.interview.question.send') }}">
    @csrf

    <div class="question-wrapper">
      @for($index = 1; $index <= 3; $index++)
      <div class="question">
				質問{{$index}}：{{$input['question-'.$index]}}
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

	   @include('components.parts.button.form.transition_button', ['text' => '送信'])
  </form>
</div>
<script type="text/javascript" src="{{ asset('/js/st/interview/question/form_confirm.js') }}"></script>
@endsection
