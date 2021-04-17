@extends('layouts.common_hr')
@section('content')

<div class="container">
  <h1>面接の情報</h1>
  名前：{{ $interviewInfo->hr_user->name }}
  会社ID：{{ $interviewInfo->hr_user->company_id }}
  日時：{{ $interviewInfo->date }}
  URL：{{ $interviewInfo->url }}

  @if($flag == 0)
    <div>
      <a href="{{ route('hr.interview.question.add', $interviewInfo->id) }}" class="btn btn-primary">質問リストを作成する。</a>
    </div>
    <div>
      <span class="btn btn-secondary">面接を開始する。</span>
    </div>
  @elseif($flag == 1)
    <div>
      <a href="{{ route('hr.interview.question.edit', $interviewInfo->id) }}" class="btn btn-warning">質問リストを変更する。</a>
    </div>
    <div>
      <a href="" class="btn btn-success">質問シートをダウンロードする。</a>
    </div>
    <div>
      <a href="{{ route('hr.interview.pre', $interviewInfo->id) }}" class="btn btn-primary">面接を開始する。</a>
    </div>
  @else　
    <div>
      <a href="">面接が終了した。</a>
    </div>
  @endif


</div>
@endsection
