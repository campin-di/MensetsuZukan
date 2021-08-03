<link href="{{ asset('css/components/parts/com_video_content.css') }}" rel="stylesheet" type="text/css">
@foreach($videosCollection as $video)
  <div class="video-wrapper">
    <div class="flex-pc">
      <div class="left-child-pc">
        <a href="{{ route($routeName, $video['id'])}}">
          <div class="video-thumbnail">
            <img src="{{ asset($video['thumbnail_path']) }}">
          </div>
        </a>
      </div>
      <div class="right-child-pc">
        <a href="{{ route($routeName, $video['id'])}}">
          <div class="video-title">
            {{ $video['stNickname'] }}さんと{{ $video['hrNickname'] }}さんとの面接
          </div>
        </a>
        <div class="other-question-wrapper">
          @foreach($video['otherQuestionsArray'] as $otherQuestion)
            <div class="other-question-selected">{{ $otherQuestion }}</div>
          @endforeach
        </div>

        <div class="video-score-wrapper flex">
          <div class="left-child">
            @include('components.parts.profile_info', [
              'upperRouteName'=> $upperRouteName,
              'stImagePath' => $video['stImagePath'],
              'underRouteName'=> $underRouteName,
              'hrImagePath' => $video['hrImagePath']
            ])
          </div>
          <div class="right-child video-score box">
            <div class="total-score count-up digital">{{ $video['total_score_integer']}}</div>
              @if($video['total_score_double'] > 99)
              <span class="digital">.{{$video['total_score_double']}}</span><span class="score-label">点</span>
              @else
              <span class="digital">.0{{$video['total_score_double']}}</span><span class="score-label">点</span>
              @endif
              <!--
              <div class='wave -one'></div>
              <div class='wave -two'></div>
              <div class='wave -three'></div>
            -->
          </div>
          <!--
          <div class='box'>
            <div class='wave -one'></div>
            <div class='wave -two'></div>
            <div class='wave -three'></div>
            <div class='title'>Capacities</div>
          </div>
            -->
        </div>
        <div class="date">
          {{ $video['diffDate'] }}
        </div>
      </div>
    </div>
  </div>
@endforeach
