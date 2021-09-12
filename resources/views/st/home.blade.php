@section('title', 'トップページ')
<link rel="stylesheet" href="{{ asset('css/st/home.css') }}">
@extends('layouts.st.common')
@section('content')
  <div class="filter-wrapper flex">
    <div class="form-input-wrapper">
      <div class="form-input">
        <select id="question" class="form-control">
          <option value="指定なし">全質問</option>
          @foreach($questions as $question)
            <option id="question-{{ $loop->iteration }}" value="{{ $question }}" @if(old('question') == "{{ $question }}") selected @endif>{{ $question }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="form-input-wrapper">
      <div class="form-input">
        <select id="score" class="form-control">
          <option value="指定なし">全得点</option>
          <option value="60">70点未満</option>
          <option value="70">70点～79点</option>
          <option value="80">80点～89点</option>
          <option value="90">90点～99点</option>
          <option value="100">100点</option>
        </select>
      </div>
    </div>
    <div class="form-input-wrapper">
      <div class="form-input">
        <select id="postedDate" class="form-control">
          <option value="指定なし">全投稿</option>
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
    @include('components.parts.video_content', ['routeName' => 'watch', 'upperRouteName' => 'stpage', 'underRouteName' => 'hrpage'])
  </div>

  @if(!empty($coverVideosCollection))
    @foreach($coverVideosCollection as $video)
      <div class="video-wrapper">
        <div class="recomend-wrapper">
          <div class="recomend-message">他の面接コンテンツを視聴するには？</div>
            <a href="{{ route('pre.contributor') }}">
              <div class="button">
                <span>詳細を確認する</span>
              </div>
            </a>
          </div>
        <div class="flex-pc mosaic">
          <div class="left-child-pc">
            <a disabled="disabled" tabindex="-1">
              <div class="video-thumbnail">
                <img src="{{ asset($video['thumbnail_path']) }}">
              </div>
            </a>
          </div>
          <div class="right-child-pc">
            <a disabled="disabled" tabindex="-1">
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
                <link href="{{ asset('css/components/parts/com_profile_info.css') }}" rel="stylesheet" type="text/css">
                <div class="profile profile-st-user">
                  <a disabled="disabled" tabindex="-1">
                    <img src="{{ asset($video['stImagePath']) }}">
                    {{ $video['stNickname'] }}<br>
                  </a>
                </div>
                <div class="profile profile-hr-user">
                  <a disabled="disabled" tabindex="-1">
                    <img src="{{ asset($video['hrImagePath']) }}">
                    {{ $video['hrNickname'] }}
                  </a>
                </div>
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
            </div>
            <div class="date">
              {{ $video['diffDate'] }}
            </div>
          </div>
        </div>
      </div>
    @endforeach
  @endif

  @include('components.parts.pc_left_fixed',[
    'img' => 'img/interview-list.svg', 
    'route' => 'interview.schedule.check',
    'description' => '面接リクエストの確認・変更' 
  ])

  @include('components.parts.pc_right_fixed',[
    'img' => 'img/search-hr.svg', 
    'route' => 'interview.search',
    'description' => '面接練習にチャレンジ！' 
  ]) 

<script type="text/javascript">
  let questions = @json($questions);
</script>
<script type="text/javascript" src="{{ asset('/js/home.js') }}"></script>
@endsection
