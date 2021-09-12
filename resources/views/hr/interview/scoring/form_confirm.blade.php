@section('title', '採点内容の確認')
<link rel="stylesheet" href="{{ asset('css/hr/interview/scoring/form_confirm.css') }}">
@extends('layouts.hr.common')
@section('content')

<div class="top-content-wrapper">
  <div class="top-content">
    <h1>採点結果の確認</h1>
  </div>
</div>

<div class="container" onload>
	<form method="post" action="{{ route('hr.interview.scoring.send') }}">
    @csrf
    
    <div class="form-wrapper content">
      <h2>選択した質問</h2>
      <div class="flex question-select-wrapper">
        @for($index = 1; $index <= 3; $index++)
          <div class="question-title">
            質問{{$index}}：{{$input['question-'.$index]}}
          </div>
        @endfor
      </div>

      <h2>採点結果</h2>
      <table class="type06">
        <thead>
          <tr>
            <th class="left-th">採点項目</th>
            <th class="right-th">評価</th>
          </tr>
        </thead>
        <tbody>
          @foreach($scoringTerms as $scoringTerm => $item)
            <tr>
              <td>{{$scoringTerm}}</td>
              <td>{{$scoringSignals[$input['term'.$loop->iteration]-1]}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>   

      <h2>学生へのアドバイス</h2>
      <div class="review">
        <h3>良かった点</h3>
        <div class="textarea">
          {{$input['review-good']}}
        </div>
        <h3>もっと魅力が伝わる面接にするには？</h3>
        <div class="textarea">
          {{$input['review-more']}}
        </div>
      </div>
    </div>

    @include('components.parts.button.form.next_button')
  </form>
</div>

@endsection
