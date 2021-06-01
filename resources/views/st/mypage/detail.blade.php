@extends('layouts.st.common')
<link rel="stylesheet" href="{{ asset('css/st/mypage/detail.css') }}">
@section('content')

<div class="container">
  @include('components.parts.page_title', ['title'=>'詳細プロフィール'])

  <div class="container_detail">
    <div class="item">
      <input id="acd-check1" class="acd-check" type="checkbox">
      <label class="acd-label" for="acd-check1">志望する企業タイプ</label>
      <div class="acd-content">
        <p>{{ $profileDetailArray['companyType'] }}</p>
      </div>
    </div>
    <div class="item">
      <input id="acd-check2" class="acd-check" type="checkbox">
      <label class="acd-label" for="acd-check2">志望業界</label>
      <div class="acd-content">
        <p>{{ $profileDetailArray['industry'] }}</p>
      </div>
    </div>
    <div class="item">
      <input id="acd-check3" class="acd-check" type="checkbox">
      <label class="acd-label" for="acd-check3">志望職種</label>
      <div class="acd-content">
        <p>{{ $profileDetailArray['jobtype'] }}</p>
      </div>
    </div>
    <div class="item">
      <input id="acd-check4" class="acd-check" type="checkbox">
      <label class="acd-label" for="acd-check4">希望勤務地</label>
      <div class="acd-content">
        <p>{{ $profileDetailArray['workplace'] }}</p>
      </div>
    </div>
    <div class="item">
      <input id="acd-check5" class="acd-check" type="checkbox">
      <label class="acd-label" for="acd-check5">就活開始時期</label>
      <div class="acd-content">
        <p>{{ $profileDetailArray['startTime'] }}</p>
      </div>
    </div>
    <div class="item">
      <input id="acd-check6" class="acd-check" type="checkbox">
      <label class="acd-label" for="acd-check6">英語レベル</label>
      <div class="acd-content">
        <p>{{ $profileDetailArray['englishLevel'] }}</p>
      </div>
    </div>
    <div class="item">
      <input id="acd-check7" class="acd-check" type="checkbox">
      <label class="acd-label" for="acd-check7">TOEICスコア</label>
      <div class="acd-content">
        <p>{{ $profileDetailArray['toeic'] }}</p>
      </div>
    </div>

    <div class="item">
      <input id="acd-check8" class="acd-check" type="checkbox">
      <label class="acd-label" for="acd-check8">簡単な自己紹介</label>
      <div class="acd-content">
        <p>{{ $profileDetailArray['gakuchika'] }}</p>
      </div>
    </div>
    <div class="item">
    <input id="acd-check9" class="acd-check" type="checkbox" />
      <label class="acd-label" for="acd-check9">強み</label>
      <div class="acd-content">
        <div>{{ $profileDetailArray['strengths'] }}</div>
      </div>
    </div>
    <div class="item">
      <input id="acd-check10" class="acd-check" type="checkbox">
      <label class="acd-label" for="acd-check10">ガクチカ</label>
      <div class="acd-content">
        <p>{{ $profileDetailArray['gakuchika'] }}</p>
      </div>
    </div>
    <div class="item">
      <input id="acd-check11" class="acd-check" type="checkbox">
      <label class="acd-label" for="acd-check11">性格</label>
      <div class="acd-content">
        <p>{{ $profileDetailArray['personality'] }}</p>
      </div>
    </div>
    <div class="item">
      <input id="acd-check12" class="acd-check" type="checkbox">
      <label class="acd-label" for="acd-check12">英語以外の言語使用経験</label>
      <div class="acd-content">
        <p>{{ $profileDetailArray['otherLanguage'] }}</p>
      </div>
    </div>
    <div class="item">
      <input id="acd-check13" class="acd-check" type="checkbox">
      <label class="acd-label" for="acd-check13">資格・受賞歴等</label>
      <div class="acd-content">
        <p>{{ $profileDetailArray['qualification'] }}</p>
      </div>
    </div>

  </div>

    @include('components.parts.button.transition_button',['routeName' => 'mypage.detail.step1', 'text' => '編集'])

</div>
@endsection
