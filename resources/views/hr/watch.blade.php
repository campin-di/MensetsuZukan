@section('title', $mainVideo['stNickname'].'さんと'.$mainVideo['hrNickname'].'さんの面接')
<link href="{{ asset('/css/st/watch.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>@extends('layouts.st.common')

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
           </div>        
        </div>
        <div class="each-score score-expression flex">
          <div class="item">自己表現力</div>
          <div class="score-value digital">
            @if($mainVideo['expression_score_double'] == 0)
              <span class="count-up">{{ $mainVideo['expression_score_integer'] }}</span>.<span class="zero">000</span><span class="fix-width">/20</span><span class="score-unit">点</span>
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
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
        このスコア帯の特徴・改善方法
      </button>

      <!-- Modal -->
      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body-wrapper">
              <div class="modal-body">
                <div class="swiper-container">
                  <div class="swiper-wrapper">
                    @foreach($scoringFeatures as $key => $featuresArray)
                      <div class="swiper-slide slide-{{ $key }}">
                        <!-- start:コンテンツ -->
                        <div class="modal-title-wrapper">
                          <img class="force-logo {{ $key }}" src="{{ asset('img/icon/'.$key.'.svg') }}">
                          <h2>{{ $featuresArray['title'] }}</h2>
                        </div>
                        <div class="modal-score">
                          <div class="modal-total-score-title">得点率</div>
                          <div class="modal-total-score count-up digital">{{ $featuresArray['rate'] }}<span>%</span></div>
                        </div>
                        <div class="modal-score-ave">（全国平均：{{ $featuresArray['ave'] }}％）</div>
                        <div class="features">
                          <div class="features-item">
                            <div class="title">このスコア帯の人の特徴</div>
                            <div class="content">{{ $featuresArray['feature'] }}</div>
                          </div>
                          <div class="features-item">
                            <div class="title">次のステップに上がるために</div>
                            <div class="content">{{ $featuresArray['measure'] }}</div>
                          </div>
                        </div>
                        <!-- end:コンテンツ -->
                      </div>
                    @endforeach
                  </div>
                  <div class="swiper-pagination"></div>
                  <div class="swiper-button-prev"></div>
                  <div class="swiper-button-next"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="review-wrapper">
    <div class="review-title-wrapper flex">
      <div class="review-title">
        <h2>評価の内訳</h2>
      </div>
      <div class="review-mark">
        ▼
      </div>
    </div>
    <div class="score-detail">
      <div class="List">
        <div class="List-Item item-title">
          <p class="List-Item-Title">項目</p>
          <p class="List-Item-Text">評価</p>
          <p class="List-Item-force ">関係する力</p>
        </div>
        @foreach($scoreDetailsArray as $scoreDetail)
          <div class="List-Item">
            <p class="List-Item-Title">{{$scoreDetail[1]}}</p>
            <p class="List-Item-Text">{{$scoreDetail[2]}}</p>
            <p class="List-Item-force">
              @foreach($scoreDetail[0] as $icon)
                <img class="force-logo {{$icon}}" src="{{ asset('img/icon/'.$icon.'.svg') }}">
              @endforeach
            </p>
          </div>
        @endforeach
      </div>
    </div>
    <div class="score-description-wrapper">
      <div class="flex">
        <div class="score-signal"> ×<span>：</span></div>
        <div class="score-description">改善しなければデメリットになる可能性が高い。</div>
      </div>
      <div class="flex">
        <div class="score-signal"> △<span>：</span></div>
        <div class="score-description">人事さんによってはウィークポイントに感じる可能性がある。</div>
      </div>
      <div class="flex">
        <div class="score-signal"> ○<span>：</span></div>
        <div class="score-description">ほとんどの人事さんが良い印象・判断をすると思われる。</div>
      </div>
      <div class="flex">
        <div class="score-signal">◎<span>：</span></div>
        <div class="score-description">明確にストロングポイントになる。</div>
      </div>
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
          <a href="{{ route('hr.stpage', $typeArray['st']['id']) }}">
            <div>
              <img src="{{ asset($typeArray['st']['img']) }}">
            </div>
            <div class="nickname">{{ $typeArray['st']['nickname'] }}</div>
          </a>
        </div>
        <ul class="type">
          @foreach($typeArray['st']['content'] as $type => $content)
            <li class="type_item">
              <dl class="wrap_features flex">
                <dt class="header_features">{{$type}}：</dt>
                <dd class="content_features ">{{$content}}</dd>
              </dl>
            </li>
          @endforeach
        </ul>
      </div>
      <div class="type-child">
        <div class="profile profile-hr-user">
          <a href="{{ route('hr.hrpage', $typeArray['hr']['id']) }}">
            <div>
              <img src="{{ asset($typeArray['hr']['img']) }}">
            </div>
            <div class="nickname">{{ $typeArray['hr']['nickname'] }}</div>
          </a>
        </div>
        <ul class="type">
          @foreach($typeArray['hr']['content'] as $type => $content)
            <li class="type_item">
              <dl class="wrap_features flex">
                <dt class="header_features">{{$type}}：</dt>
                <dd class="content_features ">{{$content}}</dd>
              </dl>
            </li>
          @endforeach
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

  @include('components.parts.pc_right_fixed',[
    'img' => 'img/interview-list.svg', 
    'route' => 'hr.interview.request',
    'description' => '面接リクエストの確認' 
  ]) 

<script>
  var mySwiper = new Swiper ('.swiper-container', {
      effect:'coverflow',
      loop: true,
      centeredSlides: true,
      pagination: {
          el: '.swiper-pagination',
          clickable: true
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      autoplay: false,
      on: {
        imagesReady: function(){
          this.el.classList.remove('loading');
        }
      }
  })
</script>

<script type="text/javascript" src="{{ asset('/js/watch.js') }}"></script>
@endsection
