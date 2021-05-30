<link href="{{ asset('css/components/parts/com_video_content.css') }}" rel="stylesheet" type="text/css">
@foreach($videosCollection as $video)
  <div class="video-wrapper">
    <div class="flex-pc">
      <div class="left-child-pc">
        <a href="{{ route($isHr.'watch', $video['id'])}}">
          <div class="video-thumbnail">
            <img src="{{ asset($video['thumbnail_path']) }}">
          </div>
        </a>
      </div>
      <div class="right-child-pc">
        <a href="{{ route($isHr.'watch', $video['id'])}}">
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

        <div class="video-score-wrapper flex">
          <div class="left-child">
            @include('components.parts.profile_info', ['stImagePath' => $video['stImagePath'], 'hrImagePath' => $video['hrImagePath']])
          </div>
          <div class="right-child video-score">
            <span>{{ $video['score']}}</span>点
          </div>
        </div>
        <div class="date">
          {{ $video['diffDate'] }}
        </div>
      </div>
    </div>
  </div>
@endforeach
