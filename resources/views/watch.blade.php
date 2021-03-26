@extends('layouts.common')
@section('content')

<div class="container">
    @foreach($videosCollection as $video)
    <a href="{{ route('watch', $video['id'])}}">
        <iframe width="560" height="315" src="{{ $video['url'] }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><br>
        {{ $video['title'] }}<br>

        <div class="d-flex justify-content-start">
          <div class="mx-2 btn btn-primary">{{ $video['question']}}</div>
          @foreach($video['otherQuestions'] as $otherquestion)
            <div class="mx-2 btn btn-secondary">
              {{ $otherquestion->question }}
            </div>
          @endforeach
        </div>

        得点：{{ $video['score']}}点<br>
        視聴回数：{{ $video['views'] }}回<br>
        いいね：{{ $video['good'] }}<br>
        人事からのレビュー：{{ $video['review'] }}<br>
        投稿日：{{ $video['diffDate'] }}<br>

        学生ユーザ名：{{ $video['stUsername'] }}<br>
        人事名：{{ $video['hrName'] }}
    </a>
    @endforeach

    <hr>

    <div>
      @foreach($otherVideosCollection as $otherVideo)
        <a href="{{ route('watch', $otherVideo['id'])}}">
          <iframe width="280" height="157.5" src="{{ $otherVideo['url'] }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><br>
          {{ $otherVideo['title'] }}<br>
          {{ $otherVideo['question'] }}<br>
          {{ $otherVideo['good'] }}<br>
          {{ $otherVideo['diffDate'] }}<br>
          {{ $otherVideo['views'] }}<br>
          {{ $otherVideo['score'] }}<br>
        </a>
      @endforeach
    </div>
</div>

@endsection
