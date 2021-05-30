@extends('layouts.st.common')
<link rel="stylesheet" href="{{ asset('css/st/interview/search.css') }}">
@section('content')

@include('components.page_title', ['title'=>'人事を探す'])

<div class="container">
  <div class="filter-wrapper flex">
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
    <a href="{{ route('hr_mypage', $hr['id']) }}">
    <div class="flex">
      <div class="left-child">
        <img class="hr-photo" src="{{ asset('/img/yoshi.jpg') }}" alt="プロフィール写真">
      </div>
      <div class="right-child">
        {{ $hr['name'] }}({{ $hr['company'] }})
      </div>
    </div>
    <div class="company-information-wrapper flex">
      <div class="company-industry">
        <img class="icon" src="{{ asset('/img/icon/industry.png') }}" alt="アイコン">
        <span class="company-information">{{ $hr['industry'] }}</span>
      </div>
      <div class="company-location">
        <img class="icon" src="{{ asset('/img/icon/industry.png') }}" alt="アイコン">
        <span>{{ $hr['location'] }}</span>
      </div>
      <div class="company-stock">
        <img class="icon" src="{{ asset('/img/icon/industry.png') }}" alt="アイコン">
        <span>{{ $hr['stock_type'] }}</span>
      </div>
    </div>
    <div class="pr-message">
      {{ $hr['introduction'] }}
    </div>
    </a>
  </div>
  @endforeach
</div>

<script type="text/javascript">
  let industries = @json($industries);
</script>
<script type="text/javascript" src="{{ asset('/js/st/interview/search.js') }}"></script>

@endsection
