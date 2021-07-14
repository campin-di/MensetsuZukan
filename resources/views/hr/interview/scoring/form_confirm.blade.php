@section('title', '採点内容の確認')
<link rel="stylesheet" href="{{ asset('css/hr/interview/scoring/form_confirm.css') }}">
@extends('layouts.hr.common')
@section('content')

<div class="top-content-wrapper">
  <div class="top-content">
    <h1>確認</h1>
  </div>
</div>

<div class="container" onload>
	<form method="post" action="{{ route('hr.interview.scoring.send') }}">
    @csrf

    <div class="form-wrapper">
      @for($index = 1; $index <= 3; $index++)
      <div class="content">
        <div class="question-title">
					質問{{$index}}：{{$input['question-'.$index]}}
				</div>

        地頭評価：{{$input['logic'.$index]}}
        人柄評価：{{$input['personality'.$index]}}
      </div>
      @endfor
      <div>
      {{$input['review-good']}}
      </div>
      <div>
      {{$input['review-more']}}
      </div>
      <div>
      {{$input['review-message']}}
      </div>
    </div>

    @include('components.parts.button.form.next_button')

  </form>
</div>

@endsection
