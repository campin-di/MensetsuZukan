@extends('layouts.common')
@section('content')

<div class="container">
    @foreach($videos_collection as $video)
      <iframe width="560" height="315" src="{{ $video['url'] }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><br>
      {{ $video['title'] }}<br>
      {{ $video['score']}}点<br>
      {{ $video['views'] }}回視聴<br>
      いいね：{{ $video['good'] }}<br>
      {{ $video['review'] }}<br>
      {{ $video['diffDate'] }}<br>
    @endforeach

  <a class="nav-link" href="{{ route('upload') }}">アップロード</a>
</div>
@endsection
