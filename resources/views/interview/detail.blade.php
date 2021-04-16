@extends('layouts.common')
@section('content')

<div class="container">
  <h1>面接の情報</h1>
  名前：{{ $interviewInfo->hr_user->name }}
  会社ID：{{ $interviewInfo->hr_user->company_id }}
  日時：{{ $interviewInfo->date }}/{{ $interviewInfo->time }}
  URL：{{ $interviewInfo->url }}
  <div>
    <a href="">
      面接を開始する。
    </a>
  </div>
</div>
@endsection
