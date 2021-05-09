@extends('layouts.hr.common')
@section('content')

<div class="container">
  <h1>マイページ</h1>
  <div>
    {{ $userDataArray['name'] }}
    {{ $userDataArray['company'] }}
  </div>

  <a href="{{ route('hr.mypage.detail') }}" class="mx-2 btn btn-primary">詳しいプロフィール</a>
  <a href="{{ route('hr.mypage.basic.show') }}" class="mx-2 btn btn-primary">基本情報を編集する</a>

  <h2>面接予定</h2>
  @foreach($interviewReservationsCollection as $interviewReservation)
    <div>
      <a href="{{ route('hr.interview.detail', $interviewReservation['id']) }}">
        {{ $interviewReservation['name'] }} {{ $interviewReservation['date'] }}
      </a>
    </div>
    <hr>
  @endforeach
  <div>
    <a href="{{ route('hr.interview.schedule.add') }}" class="mx-2 btn btn-primary">
      面接可能日程を追加する。
    </a>
  </div>

  <h2>過去の面接</h2>
  @foreach($pastVideosCollection as $video)
    <a href="{{ route('hr.watch', $video['id'])}}">
      <div>
        <img src="{{ $video['thumbnailsUrl'] }}" width="360" height="240">
      </div>
      {{ $video['title'] }}<br>

      <div class="d-flex justify-content-start">
        <div class="mx-2 btn btn-primary">{{ $video['question']}}</div>
        @foreach($video['otherQuestionsArray'] as $otherQuestion)
          <div class="mx-2 btn btn-secondary">
            {{ $otherQuestion['question']->name }}
          </div>
        @endforeach
      </div>

      {{ $video['score']}}点<br>
      {{ $video['views'] }}回視聴<br>
      いいね：{{ $video['good'] }}<br>
      {{ $video['review'] }}<br>
      {{ $video['diffDate'] }}<br>
    </a>
  @endforeach
</div>
@endsection
