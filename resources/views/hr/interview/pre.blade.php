@extends('layouts.hr.common')
@section('content')
<div class="container">
  <h1>注意事項</h1>

  <div>
    <a href="{{ route('hr.interview.detail', $interviewInfo->id) }}">戻る</a>
  </div>
  <div>
    <a id="interview_url" href="{{ route('hr.interview.scoring.form', $interviewInfo->id) }}">面接を開始する</a>
  </div>
</div>

@endsection
