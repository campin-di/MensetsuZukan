@extends('layouts.common_hr')
@section('content')

<div class="container">
  <h1>面接の情報</h1>
  名前：{{ $interviewInfo->hr_user->name }}
  会社ID：{{ $interviewInfo->hr_user->company_id }}
  日時：{{ $interviewInfo->date }}
  URL：{{ $interviewInfo->url }}
  <div>
    <a href="{{ route('hr.interview.question.add', $interviewInfo->id) }}">質問リストを作成する。</a>
  </div>
  <div>
    <a href="">面接を開始する。</a>
  </div>
  <div>
    <a href="{{ route('hr.interview.scoring.form', $interviewInfo->id) }}">面接を採点する。</a>
  </div>
</div>
@endsection
