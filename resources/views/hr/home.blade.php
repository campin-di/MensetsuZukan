@extends('layouts.hr.common')
<link rel="stylesheet" href="{{ asset('css/st/home.css') }}">
@section('content')

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

    @foreach($videosCollection as $video)
      <div class="video-wrapper">
        <div class="flex-pc">
          <div class="left-child-pc">
            <a href="{{ route('hr.watch', $video['id'])}}">
              <div class="video-thumbnail">
                <img src="{{ $video['thumbnailsUrl'] }}">
              </div>
            </a>
          </div>
          <div class="right-child-pc">
            <a href="{{ route('hr.watch', $video['id'])}}">
              <div class="video-title">
                {{ $video['title'] }}
              </div>
            </a>

            <div class="other-question-wrapper">
              <div class="other-question-selected">{{ $video['question'] }}</div>
              @foreach($video['otherQuestionsArray'] as $otherQuestion)
                <div class="other-question">
                  {{ $otherQuestion['question']->name }}
                </div>
              @endforeach
            </div>

            <div class="video-user-wrapper flex-pc pc">
              <div class="video-st-user left-child-pc">
                学生：
                <a href="{{ route('hr.stMypage', $video['stId']) }}">
                  {{ $video['stNickname'] }}<br>
                </a>
              </div>
              <div class="video-hr-user right-child-pc">
                人事：
                <a href="{{ route('hr.hr_theirPage', $video['hrId']) }}">
                  {{ $video['hrName'] }}
                </a>
              </div>
            </div>

            <div class="video-score-wrapper flex">
              <div class="left-child">
                <div class="video-good">
                  ♥　{{ $video['good'] }}
                </div>
                <div class="date">
                  〇　{{ $video['diffDate'] }}
                </div>
                <div class="video-view">
                  ▲　{{ $video['views'] }}回視聴
                </div>
              </div>
              <div class="right-child video-score">
                {{ $video['score']}}点
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach

<script type="text/javascript">
  let questions = @json($questions);
</script>
<script type="text/javascript" src="{{ asset('/js/home.js') }}"></script>
@endsection
