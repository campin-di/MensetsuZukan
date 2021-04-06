@extends('layouts.common_hr')
@section('content')

<div class="container">
    @foreach($videosCollection as $video)
    <a href="{{ route('hr.watch', $video['id'])}}">
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

        {{ $video['score']}}点<br>
        {{ $video['views'] }}回視聴<br>
        いいね：{{ $video['good'] }}<br>
        {{ $video['review'] }}<br>
        {{ $video['diffDate'] }}<br>
    </a>
    @endforeach

  <a class="nav-link" href="{{ route('hr.upload') }}">アップロード</a>
</div>
@endsection
