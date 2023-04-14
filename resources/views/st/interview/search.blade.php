@section('title', '面接官を探す')
<link rel="stylesheet" href="{{ asset('css/st/interview/search.css') }}">
@extends('layouts.st.nofooter')
@section('content')

@include('components.parts.page_title', ['title'=>'面接したい人事を選択'])

<div class="container">
  <div class="filter-wrapper flex">
    <?php /* ?>
    <div class="form-input-wrapper">
      <label for="industry" class="form-title">業界</label>
      <div class="form-input">
        <select id="industry" class="form-control">
          <option value="全業界">指定なし</option>
          @foreach($industries as $industry)
            <option id="industry-{{ $loop->iteration }}" value="{{ $industry }}" @if(old('industry') == "{{ $industry }}") selected @endif>{{ $industry }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <?php */ ?>
    <div class="form-input-wrapper">
      <label for="prefecture" class="form-title">所在地</label>
      <div class="form-input">
        <select id="prefecture" class="form-control">
          <option value="全国">指定なし</option>
          @foreach($prefecturesArray as $area => $prefectureArray)
          <optgroup label="{{ $area }}">
            @foreach($prefectureArray as $prefecture)
            <option value="{{ $prefecture }}" @if(old('prefecture') == "{{ $prefecture }}") selected @endif>{{ $prefecture }}</option>
            @endforeach
          </optgroup>
          @endforeach
        </select>
      </div>
    </div>
    <div class="form-input-wrapper">
      <label for="stockType" class="form-title">企業区分</label>
      <div class="form-input">
        <select id="stockType" class="form-control">
          <option value="全区分">指定なし</option>
          @foreach($stockTypes as $stockType)
          <option value="{{ $stockType }}" @if(old('stockType') == "{{ $stockType }}") selected @endif>{{ $stockType }}</option>
          @endforeach
        </select>
      </div>
    </div>
  </div>

  @foreach($hrCollection as $hr)
  <div class="hr-profile-wrapper">
    <a href="{{ route('interview.request', $hr['id']) }}">
    <div class="flex">
      <div class="left-child">
        <img class="hr-photo" src="{{ asset($hr['imagePath']) }}" alt="プロフィール写真">
      </div>
      <div class="right-child">
        {{ $hr['nickname'] }} ( {{ $hr['selectionPhase'] }} 対策 )
      </div>
    </div>
    <div class="company-information-wrapper flex">
    <?php /* ?>
      <div class="company-industry">
        <img class="icon" src="{{ asset('/img/icon/industry.png') }}" alt="アイコン">
        <span class="company-information">{{ $hr['industry'] }}</span>
      </div>
    <?php */ ?>
      <div class="company-location">
        <img class="icon" src="{{ asset('/img/icon/location.png') }}" alt="アイコン">
        <span>{{ $hr['location'] }}</span>
      </div>
      <div class="company-stock">
        <img class="icon" src="{{ asset('/img/icon/company_type.png') }}" alt="アイコン">
        <span>{{ $hr['stock_type'] }}</span>
      </div>
    </div>
    <div class="pr-message">
      {{ $hr['introduction'] }} 
    </div>
  </a>
  <a class="hr-mypage" href="{{ route('hrpage', $hr['id']) }}">{{$hr['nickname']}}さんについて詳しく見る</a>
  </div>
  @endforeach
</div>

<script type="text/javascript">
  let industries = @json($industries);
</script>
<script type="text/javascript" src="{{ asset('/js/st/interview/search.js') }}"></script>
@endsection
