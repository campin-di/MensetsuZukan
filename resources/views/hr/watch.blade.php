@extends('layouts.common_hr')
@section('content')

<div class="container">
    <iframe width="560" height="315" src="{{ $mainVideo['url'] }}" title="YouTube mainVideo player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><br>
    {{ $mainVideo['title'] }}<br>

    <div class="d-flex justify-content-start">
      <div class="mx-2 btn btn-primary">{{ $mainVideo['question']}}</div>
      @foreach($mainVideo['otherQuestionsArray'] as $otherQuestion)
        <div class="mx-2 btn btn-secondary">
          {{ $otherQuestion['question']->name }}
        </div>
      @endforeach
    </div>

    得点：{{ $mainVideo['score']}}点<br>
    視聴回数：{{ $mainVideo['views'] }}回<br>
    いいね：{{ $mainVideo['good'] }}<br>
    投稿日：{{ $mainVideo['diffDate'] }}<br>

    <a href="{{ route('hr.stMypage', $mainVideo['stId']) }}">
      学生ユーザ名：{{ $mainVideo['stName'] }}<br>
    </a>
    <a href="{{ route('hr.hr_theirPage', $mainVideo['hrId']) }}">
      人事名：{{ $mainVideo['hrName'] }}
    </a>

    <div>
      <a href="{{ route('hr.offer.form', $mainVideo['stId']) }}" class="mx-2 btn btn-primary">オファーする</a>
    </div>

    <hr>

    <div>
      @foreach($otherVideosCollection as $otherVideo)
        <a href="{{ route('hr.watch', $otherVideo['id'])}}">
          <div>
            <img src="{{ $otherVideo['thumbnailsUrl'] }}" width="360" height="240">
          </div>
          {{ $otherVideo['title'] }}<br>
          {{ $otherVideo['question'] }}<br>
          いいね：{{ $otherVideo['good'] }}<br>
          投稿日：{{ $otherVideo['diffDate'] }}<br>
          視聴回数：{{ $otherVideo['views'] }}回<br>
          得点：{{ $otherVideo['score'] }}点<br>
        </a>
      @endforeach
    </div>

    <h2>人事からのレビュー</h2>
    <div>
      {{ $mainVideo['review'] }}
    <div>
</div>

@endsection
