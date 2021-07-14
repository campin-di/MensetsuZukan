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
  <div class="container_detail description">
    <div class="item">
      <input id="acd-check1" class="acd-check" type="checkbox">
      <label class="acd-label" for="acd-check1">地頭の評価基準</label>
      <div class="acd-content">
        <div class="company_info">
          <ol class="evaluation evaluation-logic">
            <li>会話内容の理解が難しい。回答が遠回り/時間が長い。質問の意図から回答がずれる。</li>
            <li>会話内容が曖昧だがイメージできる。ある程度まとまった回答ができる。</li>
            <li>会話内容が環境や難易度等までイメージできる。一問一答で意図がずれずに回答できる。</li>
            <li>会話がスムーズで、ストレスを感じない。回答が簡潔で分かりやすい。</li>
            <li>会話のテンポが良く心地よい。回答も質問の意図を的確にとらえ、ビジネスレベル。</li>
          </ol>
        </div>
      </div>
    </div>
    <div class="item">
      <input id="acd-check2" class="acd-check" type="checkbox">
      <label class="acd-label" for="acd-check2">人柄の評価基準</label>
      <div class="acd-content">
        <ol class="evaluation evaluation-personality">
          <li>人柄や個性を表す言葉が出てこない。エピソードや経験の事実のみ。ネガティブな印象が強い。</li>
          <li>言葉としては出てくるが本音かどうか伝わらない。非言語が乏しい。印象は良くも悪くもない。</li>
          <li>言葉として表現でき、ある程度伝わるが浅い。人柄や個性に一貫性が無い。印象は普通に良い。</li>
          <li>言葉として表現でき、ある程度一貫性が伝わる。印象が良い。</li>
          <li>言葉と非言語でとてもうまく表現でき、一貫性もある。印象がとても良い。</li>
        </ol>
      </div>
    </div>
  </div>

  <form method="post" action="{{ route('hr.interview.scoring.post') }}">
    @csrf


    <div class="form-wrapper">
    @for($index = 1; $index <= 3; $index++)
      <div class="content">
        <div class="question">
          <select name="question-{{$index}}" required>
            <option value="">質問{{ $index }}</option>
            @foreach($questions as $question)
              <option value="{{$question->name}}">{{$question->name}}</option>
            @endforeach
          </select>  
        </div>

        <div class="score flex">
          <div>
            <div class="logic-title">
              <span class="logic-value">1</span>
              <span>地頭</span>
              <span class="logic-value">5</span>
            </div>
            <div class="radios logic">
              @for($i = 1; $i <= 5; $i++)
                <label for="logic{{$index}}-{{$i}}"></label>
                @if($i == 3)
                  <input id="logic{{$index}}-{{$i}}" name="logic{{$index}}" type="radio" value="{{$i}}" checked>
                @else
                  <input id="logic{{$index}}-{{$i}}" name="logic{{$index}}" type="radio" value="{{$i}}">
                @endif
              @endfor
              <span id="logic-slider{{$index}}" class="slide"></span>
            </div>
          </div>
          <div>
            <div class="personality-title">
              <span class="personality-value">1</span>
              <span>人柄</span>
              <span class="personality-value">5</span>
            </div>
            <div class="radios personality">
              @for($i = 1; $i <= 5; $i++)
                <label for="personality{{$index}}-{{$i}}"></label>
                @if($i == 3)
                  <input id="personality{{$index}}-{{$i}}" name="personality{{$index}}" type="radio" value="{{$i}}" checked>
                @else
                 <input id="personality{{$index}}-{{$i}}" name="personality{{$index}}" type="radio" value="{{$i}}">
                @endif
              @endfor
              <span id="personality-slider{{$index}}" class="slide"></span>
            </div>
          </div>
        </div>
      </div>
      @endfor
      <div>
        <textarea name="review-good" placeholder="例：質問に対して意図や間を汲んでテンポ良く回答ができるのは素晴らしいです。ご自身らしい価値観を背景や理由におりまぜて話してくださるので、全体を通して人柄が伝わってくるコミュニケーションでした。" required></textarea>
      </div>
      <div>
        <textarea name="review-more" placeholder="ビジョンに対する回答が漠然としており、曖昧な印象を受けました。抽象的でもいいので、目標やなりたい人物像などがもう少し整理でき意思をもって伝えられるとより良いです。" required></textarea>
      </div>
      <div>
        <textarea name="review-message" placeholder="自己紹介と挑戦したエピソードから個性が伝わってきて、とても楽しかったです。話し方や口癖などコミュニケーションに癖がなくテンポも良いので、良い印象が残る面接官が多いと思います。" required></textarea>
      </div>

    </div>

    <input type="hidden" name="interview_id" value="{{ $id }}">
    @include('components.parts.button.form.next_button')
  </form>
</div>
<script type="text/javascript">
  let zoomUrl = @json($zoomUrl);
</script>
<script type="text/javascript" src="{{ asset('/js/hr/interview/scoring/form.js') }}"></script>
@endsection
