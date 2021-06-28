@section('title', '面接前の確認事項')
<link rel="stylesheet" href="{{ asset('css/hr/interview/pre.css') }}">
@extends('layouts.hr.common')
@section('content')

@include('components.parts.page_title', ['title'=>'面接の準備はできましたか？'])

<div class="container pre-wrapper">

  <div class="attention-wrapper">
    <h2>注意事項</h2>
    <ul class="attention">
      <li>面接マニュアルに従って面接・採点をしてください。</li>
      <li>質問シートに入力した質問と同じ順で質問してください。</li>
      <li>採点の基準は採点マニュアルの中に記載してあります。</li>
    </ul>
  </div>

  <div class="message">
    下記の「面接を開始」を押して、<br>
    面接を開始してください。
  </div>

  <div class="button-wrapper negative">
    <button type="submit">
      <a href="{{ route('hr.interview.detail', $interviewInfo->id) }}">戻る</a>
    </button>
  </div>

  <div class="button-wrapper">
    <button type="submit">
      <a id="interview_url" href="{{ route('hr.interview.scoring.form', $interviewInfo->id) }}">面接を開始</a>
    </button>
  </div>
</div>

@endsection
