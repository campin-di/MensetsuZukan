@section('title', $mainVideo['title'])
<link href="{{ asset('/css/st/watch.css') }}" rel="stylesheet">
@extends('layouts.hr.common')
@section('content')
  @include('components.parts.button.fixed_button', ['routeName' => 'hr.offer.form', 'var'=>$mainVideo['stId'], 'msg' => '', 'text' => $mainVideo['stNickname'].'さんにオファーを送る'])

  <div class="video-iframe">
    <iframe src="{{ $mainVideo['vimeo_src'] }}" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen title=""></iframe>
  </div>

  <div class="video-iframe-under">
    をクリックすると次の質問までスキップできます！
  </div>

  <div class="container">
    <div class="video-title">
    {{ $mainVideo['stNickname'] }}さんと{{ $mainVideo['hrNickname'] }}さんの面接
    </div>
    <div class="video-view-good-wrapper flex">
      <div class="video-view">
        {{ $mainVideo['diffDate'] }}
      </div>
    </div>

    <div class="other-question-wrapper">
    @foreach($mainVideo['otherQuestionsArray'] as $otherQuestion)
      <div class="other-question-selected">{{ $otherQuestion }}</div>
    @endforeach
  </div>

  <div class="review-wrapper">
    <div class="review-title-wrapper flex">
      <div class="review-title">
        <h2>面接採点DX</h2>
      </div>
      <div class="review-mark">
        ▼
      </div>
    </div>
    <div class="score">
    <div class="each-score-wrapper child_1" id="each">
        <div class="each-score score-basic flex">
          <div class="item">面接基礎力</div>
          <div class="score-value digital">
            @if($mainVideo['basic_score_double'] == 0)
              <span class="count-up">{{ $mainVideo['basic_score_integer'] }}</span>.<span class="zero">000</span><span class="fix-width">/16</span><span class="score-unit">点</span>
            @elseif($mainVideo['basic_score_double'] < 100)
              <span class="count-up">{{ $mainVideo['basic_score_integer'] }}</span>.0<span class="count-up">{{ $mainVideo['basic_score_double'] }}</span><span class="fix-width">/32</span><span class="score-unit">点</span>
            @else
              <span class="count-up">{{ $mainVideo['basic_score_integer'] }}</span>.<span class="count-up">{{ $mainVideo['basic_score_double'] }}</span><span class="fix-width">/32</span><span class="score-unit">点</span>
            @endif
         </div>        </div>
        <div class="each-score score-expression flex">
          <div class="item">自己表現力</div>
          <div class="score-value digital">
            @if($mainVideo['expression_score_double'] == 0)
              <span class="count-up">{{ $mainVideo['expression_score_integer'] }}</span>.<span class="zero">000</span><span class="fix-width">/16</span><span class="score-unit">点</span>
            @elseif($mainVideo['expression_score_double'] < 100)
              <span class="count-up">{{ $mainVideo['expression_score_integer'] }}</span>.0<span class="count-up">{{ $mainVideo['expression_score_double'] }}</span><span class="fix-width">/20</span><span class="score-unit">点</span>
            @else
              <span class="count-up">{{ $mainVideo['expression_score_integer'] }}</span>.<span class="count-up">{{ $mainVideo['expression_score_double'] }}</span><span class="fix-width">/20</span><span class="score-unit">点</span>
            @endif
         </div>        </div>
        <div class="each-score score-logic flex">
          <div class="item">ロジカル力</div>
          <div class="score-value digital">
            @if($mainVideo['logical_score_double'] == 0)
              <span class="count-up">{{ $mainVideo['logical_score_integer'] }}</span>.<span class="zero">000</span><span class="fix-width">/16</span><span class="score-unit">点</span>
            @elseif($mainVideo['logical_score_double'] < 100)
              <span class="count-up">{{ $mainVideo['logical_score_integer'] }}</span>.0<span class="count-up">{{ $mainVideo['logical_score_double'] }}</span><span class="fix-width">/16</span><span class="score-unit">点</span>
            @else
              <span class="count-up">{{ $mainVideo['logical_score_integer'] }}</span>.<span class="count-up">{{ $mainVideo['logical_score_double'] }}</span><span class="fix-width">/16</span><span class="score-unit">点</span>
            @endif
         </div>        </div>
        <div class="each-score score-vitality flex">
          <div class="item">バイタリティ</div>
          <div class="score-value digital">
            @if($mainVideo['vitality_score_double'] == 0)
              <span class="count-up">{{ $mainVideo['vitality_score_integer'] }}</span>.<span class="zero">000</span><span class="fix-width">/16</span><span class="score-unit">点</span>
            @elseif($mainVideo['vitality_score_double'] < 100)
              <span class="count-up">{{ $mainVideo['vitality_score_integer'] }}</span>.0<span class="count-up">{{ $mainVideo['vitality_score_double'] }}</span><span class="fix-width">/16</span><span class="score-unit">点</span>
            @else
              <span class="count-up">{{ $mainVideo['vitality_score_integer'] }}</span>.<span class="count-up">{{ $mainVideo['vitality_score_double'] }}</span><span class="fix-width">/16</span><span class="score-unit">点</span>
            @endif
         </div>
        </div>
        <div class="each-score score-creative flex">
          <div class="item">創造力</div>
          <div class="score-value digital">
            @if($mainVideo['creative_score_double'] == 0)
              <span class="count-up">{{ $mainVideo['creative_score_integer'] }}</span>.<span class="zero">000</span><span class="fix-width">/16</span><span class="score-unit">点</span>
            @elseif($mainVideo['creative_score_double'] < 100)
              <span class="count-up">{{ $mainVideo['creative_score_integer'] }}</span>.0<span class="count-up">{{ $mainVideo['creative_score_double'] }}</span><span class="fix-width">/16</span><span class="score-unit">点</span>
            @else
              <span class="count-up">{{ $mainVideo['creative_score_integer'] }}</span>.<span class="count-up">{{ $mainVideo['creative_score_double'] }}</span><span class="fix-width">/16</span><span class="score-unit">点</span>
            @endif
         </div>
        </div>
      </div>
      <div class="total-score-wrapper child_2" id="total">
        <div class="total-score-title">総合得点</div>
        <div class="total-score count-up digital">{{ $mainVideo['total_score_integer'] }}</div>
        @if($mainVideo['total_score_double'] > 99)
          <div class="total-score-under digital">.<span class="count-up">{{ $mainVideo['total_score_double'] }}</span><span>点</span></div>
        @else
          <div class="total-score-under digital">.0<span class="count-up">{{ $mainVideo['total_score_double'] }}</span><span>点</span></div>
        @endif
      </div>
    </div>
  <div class="score-detail">

    </div>
  </div>
  
  <div class="review-wrapper">
    <div class="review-title-wrapper flex">
      <div class="review-title">
        <h2>学生タイプと人事タイプ</h2>
      </div>
      <div class="review-mark">
        ▼
      </div>
    </div>
    <div class="type-wrapper flex">
      <div class="type-child">
        <div class="profile profile-st-user">
          <a href="{{ route('hr.stpage', $mainVideo['stId']) }}">
            <div>
              <img src="{{ asset($mainVideo['stImagePath']) }}">
            </div>
            <div class="nickname">{{ $mainVideo['stNickname'] }}</div>
          </a>
        </div>
        <ul class="type">
          <li class="type_item">
            <dl class="wrap_features flex">
              <dt class="header_features">志望業界：</dt>
              <dd class="content_features ">{{ $mainVideo['stIndustry'] }}</dd>
            </dl>
          </li>
          <li class="type_item">
            <dl class="wrap_features flex">
              <dt class="header_features">志望企業タイプ：</dt>
              <dd class="content_features ">{{ $mainVideo['stCompanyType'] }}</dd>
            </dl>
          </li>
          <li class="type_item">
            <dl class="wrap_features flex">
              <dt class="header_features">志望職種：</dt>
              <dd class="content_features ">{{ $mainVideo['stJobType'] }}</dd>
            </dl>
          </li>
          <li class="type_item">
            <dl class="wrap_features flex">
              <dt class="header_features">大学群：</dt>
              <dd class="content_features ">{{ $mainVideo['stUniversityClass'] }}</dd>            
            </dl>
          </li>
          <li class="type_item">
            <dl class="wrap_features flex">
              <dt class="header_features">卒業年度（見込み）：</dt>
              <dd class="content_features ">{{ $mainVideo['stGraduateYear'] }}</dd>            
            </dl>
          </li>
          </li>
          <li class="type_item">
            <dl class="wrap_features flex">
              <dt class="header_features">就活を開始した時期：</dt>
              <dd class="content_features ">{{ $mainVideo['stStartTime'] }}</dd>            
            </dl>
          </li>
        </ul>
      </div>
      <div class="type-child">
        <div class="profile profile-hr-user">
          <a href="{{ route('hr.hrpage', $mainVideo['hrId']) }}">
            <div>
              <img src="{{ asset($mainVideo['hrImagePath']) }}">
            </div>
            <div class="nickname">{{ $mainVideo['hrNickname'] }}</div>
          </a>
        </div>
        <ul class="type">
          <li class="type_item">
            <dl class="wrap_features flex">
              <dt class="header_features">所属業界：</dt>
              <dd class="content_features ">{{ $mainVideo['hrIndustry'] }}</dd>
            </dl>
          </li>
          <li class="type_item">
            <dl class="wrap_features flex">
              <dt class="header_features">所属企業所在地：</dt>
              <dd class="content_features ">{{ $mainVideo['hrLocation'] }}</dd>            
            </dl>
          </li>
          <li class="type_item">
            <dl class="wrap_features flex">
              <dt class="header_features">企業タイプ：</dt>
              <dd class="content_features ">{{ $mainVideo['hrCompanyType'] }}</dd>
            </dl>
          </li>
          <li class="type_item">
            <dl class="wrap_features flex">
              <dt class="header_features">上場区分：</dt>
              <dd class="content_features ">{{ $mainVideo['hrStockType'] }}</dd>
            </dl>
          </li>
          <li class="type_item">
            <dl class="wrap_features flex">
              <dt class="header_features">普段の担当選考フェーズ：</dt>
              <dd class="content_features ">{{ $mainVideo['hrSelectionPhase'] }}</dd>            
            </dl>
          </li>

        </ul>
      </div>
    </div>
  </div>

  <div class="review-wrapper">
    <div class="review-title-wrapper flex">
      <div class="review-title">
        <h2>面接官からのコメント</h2>
      </div>
      <div class="review-mark">
        ▼
      </div>
    </div>
    <div class="review">
      <a class="flex" href="{{ route('hr.hrpage', $mainVideo['hrId']) }}">
        <div class="profile profile-hr-user profile-comment">
          <img src="{{ asset($mainVideo['hrImagePath']) }}">
        </div>
        <div class="nickname">{{ $mainVideo['hrNickname'] }}</div>
      </a>
      <h3>よかった点</h3>
      <p>
        {{ $mainVideo['review_good'] }}
      </p>
      <h3>もっと魅力が伝わる面接にするには？</h3>
      <p>
        {{ $mainVideo['review_more'] }}
      </p>
    </div>
  </div>
</div>
<script type="text/javascript" src="{{ asset('/js/watch.js') }}"></script>
@endsection
