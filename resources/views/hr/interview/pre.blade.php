@extends('layouts.hr.common')
<link rel="stylesheet" href="{{ asset('css/hr/interview/pre.css') }}">
@section('content')

@include('components.parts.page_title', ['title'=>'面接の準備はできましたか？'])

<div class="container pre-wrapper">

  <div class="attention-wrapper">
    <h2>注意事項</h2>
    <ul class="attention">
      <li>質問シートを手元に準備できましたか？</li>
      <li>質問シートの順で質問してください。</li>
      <li>面接マニュアルに従って面接をしてください。</li>
      <li>面接後「採点」してください。</li>
    </ul>
  </div>

  <div class="message">
    下記の「面接会場へ」を押して、<br>
    面接を開始してください。
  </div>

  <div class="button-wrapper negative">
    <button type="submit">
      <a href="{{ route('hr.interview.detail', $interviewInfo->id) }}">戻る</a>
    </button>
  </div>

  <div class="button-wrapper">
    <button type="submit">
      <a id="interview_url" href="{{ route('hr.interview.scoring.form', $interviewInfo->id) }}">面接を開始する</a>
    </button>
  </div>
</div>

@endsection
