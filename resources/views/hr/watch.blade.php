@extends('layouts.common_hr')
@section('content')

<div class="container">
    @foreach($videosCollection as $video)
        <iframe width="560" height="315" src="{{ $video['url'] }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><br>
        {{ $video['title'] }}<br>

        <div class="d-flex justify-content-start">
          <div class="mx-2 btn btn-primary">{{ $video['question']}}</div>
          @foreach($video['otherQuestionsArray'] as $otherQuestion)
            <div class="mx-2 btn btn-secondary">
              {{ $otherQuestion['question']->name }}
            </div>
          @endforeach
        </div>

        得点：{{ $video['score']}}点<br>
        視聴回数：{{ $video['views'] }}回<br>
        いいね：{{ $video['good'] }}<br>
        人事からのレビュー：{{ $video['review'] }}<br>
        投稿日：{{ $video['diffDate'] }}<br>

        <a href="{{ route('hr.stMypage', $video['stId']) }}">
          学生ユーザ名：{{ $video['stName'] }}<br>
        </a>
        <a href="{{ route('hr.hr_theirPage', $video['hrId']) }}">
          人事名：{{ $video['hrName'] }}
        </a>
    @endforeach

    <div>
      <a href="{{ route('hr.offer.form', $video['stId']) }}" class="mx-2 btn btn-primary">オファーする</a>
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
</div>

@endsection
