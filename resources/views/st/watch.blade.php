@extends('layouts.st.common')
<link href="{{ asset('/css/st/watch.css') }}" rel="stylesheet">
@section('content')

  <div class="container">
    <div class="video-iframe">
      <iframe src="{{ $mainVideo['url'] }}" title="YouTube mainVideo player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>

    <div class="video-title">
      {{ $mainVideo['title'] }}
    </div>
    <div class="video-view-good-wrapper flex">
      <div class="video-view">
        {{ $mainVideo['views'] }}回視聴・{{ $mainVideo['diffDate'] }}
      </div>
      <div class="video-good">
        ♥：{{ $mainVideo['good'] }}
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
        <div class="video-st-user">
          学生：
          <a href="{{ route('mypage.theirPage', $mainVideo['stId']) }}">
            {{ $mainVideo['stNickname'] }}<br>
          </a>
        </div>
        <div class="video-hr-user">
          人事：
          <a href="{{ route('hr_mypage', $mainVideo['hrId']) }}">
            {{ $mainVideo['hrName'] }}
          </a>
        </div>
      </div>
      <div class="right-child video-score">
        {{ $mainVideo['score']}}点
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
                <img src="{{ $otherVideo['thumbnailsUrl'] }}">
              </div>
            </a>
          </div>
          <div class="right-child">
            <div class="other-video-title">
              <a href="{{ route('watch', $otherVideo['id'])}}">
                コンテンツのタイトルがここに表示されます。
                <!-- 文字数カットの処理をJSで書いたらコメントアウト
                {{ $otherVideo['title'] }}
                -->
              </a>
            </div>
            <div class="other-video-views-score-wrapper flex">
              <div class="other-video-views">
                <div class="pc flex">
                  <div class="other-video-good">
                    ♥　{{ $otherVideo['good'] }}
                  </div>
                  <div class="other-video-date">
                    〇　{{ $otherVideo['diffDate'] }}
                  </div>
                </div>
                {{ $mainVideo['views'] }}回視聴
              </div>
              <div class="other-video-score">
                {{ $mainVideo['score']}}点
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
@endsection