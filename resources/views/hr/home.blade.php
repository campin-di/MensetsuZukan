@extends('layouts.hr.common')
<link rel="stylesheet" href="{{ asset('css/st/home.css') }}">
@section('content')

<div class="filter-wrapper flex">
  <div class="form-input-wrapper">
    <label for="question" class="form-title">質問</label>
    <div class="form-input">
      <select id="question" class="form-control">
        <option value="指定なし">指定なし</option>
        @foreach($questions as $question)
          <option id="question-{{ $loop->iteration }}" value="{{ $question }}" @if(old('question') == "{{ $question }}") selected @endif>{{ $question }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="form-input-wrapper">
    <label for="score" class="form-title">得点</label>
    <div class="form-input">
      <select id="score" class="form-control">
        <option value="指定なし">指定なし</option>
        <option value="70">70点未満</option>
        <option value="75">75点～79点</option>
        <option value="80">80点～84点</option>
        <option value="85">85点～89点</option>
        <option value="90">90点～94点</option>
        <option value="95">95点～99点</option>
        <option value="100">100点</option>
      </select>
    </div>
  </div>
  <div class="form-input-wrapper">
    <label for="postedDate" class="form-title">投稿日</label>
    <div class="form-input">
      <select id="postedDate" class="form-control">
        <option value="指定なし">指定なし</option>
        <option value="1-w">1週間以内</option>
        <option value="1-m">1ヶ月以内</option>
        <option value="3-m">3ヶ月以内</option>
        <option value="6-m">6ヶ月以内</option>
        <option value="1-y">1年以内</option>
      </select>
    </div>
  </div>
</div>

<div class="contents-wrapper">
  @foreach($videosCollection as $video)
    <div class="video-wrapper">
      <div class="flex-pc">
        <div class="left-child-pc">
          <a href="{{ route('hr.watch', $video['id'])}}">
            <div class="video-thumbnail">
              <img src="{{ asset($video['thumbnail_src']) }}">
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
                {{ $video['diffDate'] }}
              </div>
              <div class="video-view">
                ▲　{{ $video['views'] }}回視聴
              </div>
            </div>
            <div class="right-child video-score">
              <span>{{ $video['score']}}</span>点
            </div>
          </div>
        </div>
      </div>
    </div>
  @endforeach
</div>

<script type="text/javascript">
  let questions = @json($questions);
</script>
<script type="text/javascript" src="{{ asset('/js/home.js') }}"></script>
@endsection
