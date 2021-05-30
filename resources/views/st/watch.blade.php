@extends('layouts.st.common')
<link href="{{ asset('/css/st/watch.css') }}" rel="stylesheet">
@section('content')

<div class="video-iframe">
  <iframe src="{{ $mainVideo['vimeo_src'] }}" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen title=""></iframe></div>
</div>
<div class="container">
  <div class="video-title">
    {{ $mainVideo['title'] }}
  </div>
  <div class="video-view-good-wrapper flex">
    <div class="video-view">
      {{ $mainVideo['views'] }}回視聴・{{ $mainVideo['diffDate'] }}
    </div>
  </div>

  <div class="other-question-wrapper">
    <div class="other-question-selected">{{ $mainVideo['question']}}</div>
    @foreach($mainVideo['otherQuestionsArray'] as $otherQuestion)
      <div class="other-question">
        {{ $otherQuestion['question']->name }}
      </div>
    @endforeach
  </div>

  <div class="video-user-score-wrapper flex">
    <div class="left-child">
      @include('components.parts.profile_info', ['video' => $mainVideo, 'isHr' => '', 'stImagePath' => $mainVideo['stImagePath'], 'hrImagePath' => $mainVideo['hrImagePath']])
    </div>
    <div class="right-child video-score">
      <span>{{ $mainVideo['score'] }}</span>点
    </div>
  </div>

  <div class="other-videos-wrapper">
    <div class="other-videos-title-wrapper flex">
      <div class="other-videos-title">
        <h2>面接中にされた他の質問</h2>
      </div>
      <div class="other-videos-mark">
        ▼
      </div>
    </div>

    @foreach($otherVideosCollection as $otherVideo)
      <div class="other-video flex">
        <div class="left-child">
          <a href="{{ route('watch', $otherVideo['id'])}}">
            <div class="other-video-thumbnail">
              <img src="{{ asset($otherVideo['thumbnail_path']) }}">
            </div>
          </a>
        </div>
        <div class="right-child">
          <div class="other-video-title">
            <a href="{{ route('watch', $otherVideo['id'])}}">
              {{ $otherVideo['title'] }}
            </a>
          </div>
          <div class="other-video-views-score-wrapper flex">
            <div class="other-video-views">
              <div class="pc flex">
                <div class="other-video-date">
                  {{ $otherVideo['views'] }}回視聴・
                  {{ $otherVideo['diffDate'] }}
                </div>
              </div>
            </div>
            <div class="other-video-score">
              <span>{{ $otherVideo['score']}}</span>点
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  <div class="review-wrapper">
    <div class="review-title-wrapper flex">
      <div class="review-title">
        <h2>人事からのレビュー</h2>
      </div>
      <div class="review-mark">
        ▼
      </div>
    </div>
    <div class="review">
      <a href="{{ route('hr_mypage', $mainVideo['hrId']) }}">
        {{ $mainVideo['hrName'] }}
      </a>
      <p>
        {{ $mainVideo['review'] }}
      </p>
    </div>
  </div>
</div>


  <script type="text/javascript" src="{{ asset('/js/watch.js') }}"></script>
  <script src="https://player.vimeo.com/api/player.js"></script>
@endsection
