@extends('layouts.st.common')
@section('content')
<link rel="stylesheet" href="{{ asset('css/st/home.css') }}">

  <div class="button-box">
    <button id="button-all">
      <p id="text-all">ALL</p>
    </button>
    @foreach($questions as $question)
      <button id="button-{{ $loop->iteration }}">
        <p id="text-{{ $loop->iteration }}">{{ $question }}</p>
      </button>
    @endforeach
  </div>

  <div class="inner-body">
    @foreach($videosCollection as $video)
      <div class="content-box">
        <a href="{{ route('watch', $video['id'])}}">
            <div>
              <img src="{{ $video['thumbnailsUrl'] }}" width="360" height="240">
            </div>
            {{ $video['title'] }}<br>

            <div class="d-flex justify-content-start">
              <div class="question-selected mx-2 btn btn-primary">{{ $video['question']}}</div>
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
      </div>
    @endforeach
  </div>

<script type="text/javascript">
  let questions = @json($questions);
</script>
<script type="text/javascript" src="{{ asset('/js/home.js') }}"></script>
@endsection
