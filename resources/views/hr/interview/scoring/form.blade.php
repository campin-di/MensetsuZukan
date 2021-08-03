@section('title', '採点画面')
<link rel="stylesheet" href="{{ asset('css/hr/interview/scoring/form.css') }}">
@extends('layouts.hr.common')
@section('content')

<div class="top-content-wrapper">
  <div class="top-content">
    <h1>面接採点を開始する。</h1>
  </div>
</div>

<div class="container" onload>
  <form method="post" action="{{ route('hr.interview.scoring.post') }}">
    @csrf
    <div class="form-wrapper">
    <div class="content">
      <h2>質問を選択してください。</h2>
      <div class="flex question-select-wrapper">
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

      <h2>採点を行ってください。</h2>
      @foreach($scoringTerms as $scoringTerm)
        <div class="score flex">
          <div class="scoring_term">{{ $scoringTerm }}</div>
          <div class="radios logic">
              <label for="term{{$loop->iteration}}-1">
                <img src="{{ asset('../img/icon/batsu.svg') }}" alt="×" class="score-triangle">
              </label>
              <input id="term{{$loop->iteration}}-1" name="term{{$loop->iteration}}" type="radio" value="1" checked>
              <label for="term{{$loop->iteration}}-2">
                <img src="{{ asset('../img/icon/triangle.svg') }}" alt="△" class="score-triangle">
              </label>
              <input id="term{{$loop->iteration}}-2" name="term{{$loop->iteration}}" type="radio" value="2">
              <label for="term{{$loop->iteration}}-3">
                <img src="{{ asset('../img/icon/circle.svg') }}" alt="○">
              </label>
              <input id="term{{$loop->iteration}}-3" name="term{{$loop->iteration}}" type="radio" value="3">
              <label for="term{{$loop->iteration}}-4">
                <img src="{{ asset('../img/icon/double_circle.svg') }}" alt="◎">
              </label>
              <input id="term{{$loop->iteration}}-4" name="term{{$loop->iteration}}" type="radio" value="4">
            <span id="term-slider{{$loop->iteration}}" class="slide"></span>
          </div>
        </div>
      @endforeach
      </div>

      <h2>学生へのアドバイス</h2>
      <div class="review">
        <h3>良かった点</h3>
        <textarea name="review-good" placeholder="例：質問に対して意図や間を汲んでテンポ良く回答ができるのは素晴らしいです。ご自身らしい価値観を背景や理由におりまぜて話してくださるので、全体を通して人柄が伝わってくるコミュニケーションでした。" required></textarea>
        <h3>もっと魅力が伝わる面接にするには？</h3>
        <textarea name="review-more" placeholder="ビジョンに対する回答が漠然としており、曖昧な印象を受けました。抽象的でもいいので、目標やなりたい人物像などがもう少し整理でき意思をもって伝えられるとより良いです。" required></textarea>
      </div>

    </div>

    <input type="hidden" name="interview_id" value="{{ $id }}">
    @include('components.parts.button.form.next_button')
  </form>

  <div class="container_detail description">
    <div class="item">
      <input id="acd-check1" class="acd-check" type="checkbox">
      <label class="acd-label" for="acd-check1">採点メモ</label>
      <div class="acd-content">
        <textarea class="memo" placeholder="採点中のメモなど、ご自由にお使いください。またここに書かれた文章はデータには残らないのでご安心ください。"></textarea>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  let zoomUrl = @json($zoomUrl);
</script>
<script type="text/javascript" src="{{ asset('/js/hr/interview/scoring/form.js') }}"></script>
@endsection
