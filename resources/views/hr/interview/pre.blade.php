@extends('layouts.common_hr')
@section('content')

<div class="container">
  <h1>注意事項</h1>

  <div>
    <a href="{{ route('hr.interview.detail', $interviewInfo->id) }}">戻る</a>
  </div>
  <div>
    <a href="{{ $interviewInfo->url }}" target="_blank">面接を開始する</a>
  </div>
</div>
@endsection
