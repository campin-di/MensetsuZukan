@extends('layouts.hr.common')
<link rel="stylesheet" href="{{ asset('css/hr/interview/scoring/form_confirm.css') }}">
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
					質問{{$index}}：{{$input['question-'.$index. '-name']}}
				</div>
        <div class="range">
          <span>{{$input['question-'.$index]}}</span>点
        </div>
				{{$input['review-'.$index]}}
      </div>
      @endfor
    </div>

    <div class="button-wrapper">
      <button type="submit">
        →
      </button>
    </div>

  </form>
</div>

<script src="{{ asset('/js/hr/interview/scoring/form.js') }}"></script>

@endsection
