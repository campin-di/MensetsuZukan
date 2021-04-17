@extends('layouts.common_hr')
@section('content')

<div class="container">
    @foreach($videosCollection as $video)
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

  <a class="nav-link" href="{{ route('upload') }}">アップロード</a>
</div>
@endsection
