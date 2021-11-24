@section('title', 'オファーする学生を探す')
<link rel="stylesheet" href="{{ asset('css/hr/offer/search.css') }}">
@extends('layouts.hr.nofooter')
@section('content')

<div class="container">
  <div class="filter-wrapper">
    <form method="post" action="{{ route('hr.offer.search.filter') }}">
      @csrf
      <div class="flex">
        <div class="form-input-wrapper">
          <div class="form-input">
            <select id="industry" name="industry" class="form-control">
              
              @if(isset($request_industry))
                <option value="{{ $request_industry }}" selected>{{ $request_industry }}</option>
              @endif
              <option value="">▼ 志望業界</option>
              @foreach($industries as $industry)
                <option value="{{ $industry }}" @if(old('industry') == "{{ $industry }}") selected @endif>{{ $industry }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-input-wrapper">
          <div class="form-input">
            <select id="jobtype" name="jobtype" class="form-control">
              
              @if(isset($request_jobtype))
                <option value="{{ $request_jobtype }}" selected>{{ $request_jobtype }}</option>
              @endif
              <option value="">▼ 志望職種</option>
              @foreach($jobtypes as $jobtype)
                <option value="{{ $jobtype }}" @if(old('jobtype') == "{{ $jobtype }}") selected @endif>{{ $jobtype }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-input-wrapper">
          <div class="form-input">
            <select id="company_type" name="company_type" class="form-control">
              
              @if(isset($request_company_type))
                <option value="{{ $request_company_type }}" selected>{{ $request_company_type }}</option>
              @endif
              <option value="">▼ 志望企業タイプ</option>
              @foreach($companyTypes as $company_type)
                <option value="{{ $company_type }}" @if(old('company_type') == "{{ $company_type }}") selected @endif>{{ $company_type }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-input-wrapper">
          <div class="form-input">
            <select id="status" name="status" class="form-control">
              
              @if(isset($request_status))
                @if($request_status == 11)
                  <option value="{{ $request_status }}" selected>あり</option>
                @else
                  <option value="{{ $request_status }}" selected>なし</option>
                @endif
              @endif
              <option value="">▼ 面接動画</option>
                <option value="11" @if(old('status') == 11) selected @endif>あり</option>
                <option value="10" @if(old('status') == 10) selected @endif>なし</option>
            </select>
          </div>
        </div>

        <div class="form-input-wrapper">
          <div class="form-input">
            <select id="university_class" name="university_class" class="form-control">
              @if(isset($request_university_class))
                <option value="{{ $request_university_class }}" selected>{{ $request_university_class }}</option>
              @endif
              <option value="">▼ 大学グループ</option>
              @foreach($university_classes as $university_class)
              
                <option value="{{ $university_class }}" @if(old('university_class') == "{{ $university_class }}") selected @endif>{{ $university_class }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-input-wrapper">
          <div class="form-input">
            <select id="workplace" name="workplace" class="form-control">
              @if(isset($request_workplace))
                <option value="{{ $request_workplace }}" selected>{{ $request_workplace }}</option>
              @endif
              <option value="">▼ 希望勤務地</option>
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
          <div class="form-input">
            <select id="english_level" name="english_level" class="form-control">
              
              @if(isset($request_english_level))
                <option value="{{ $request_english_level }}" selected>{{ $request_english_level }}</option>
              @endif
              <option value="">▼ 英会話レベル</option>
              @foreach($englishLevels as $english_level)
                <option value="{{ $english_level }}" @if(old('english_level') == "{{ $english_level }}") selected @endif>{{ $english_level }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-input-wrapper">
          <div class="form-input">
            <select id="toeic" name="toeic" class="form-control">
              
              @if(isset($request_toeic))
                <option value="{{ $request_toeic }}" selected>{{ $request_toeic }}</option>
              @endif
              <option value="">▼ TOEICスコア</option>
              @foreach($toeics as $toeic)
                <option value="{{ $toeic }}" @if(old('toeic') == "{{ $toeic }}") selected @endif>{{ $toeic }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-input-wrapper">
          <div class="form-input">
            <select id="gender" name="gender" class="form-control">
              
              @if(isset($request_gender))
                @if($request_gender == 1)
                  <option value="{{ $request_gender }}" selected>男性</option>
                @elseif($request_gender == 2)
                  <option value="{{ $request_gender }}" selected>女性</option>
                @else
                  <option value="{{ $request_gender }}" selected>その他</option>
                @endif
              @endif
              <option value="">▼ 性別</option>
                <option value="1" @if(old('gender') == 1) selected @endif>男性</option>
                <option value="2" @if(old('gender') == 2) selected @endif>女性</option>
                <option value="3" @if(old('gender') == 3) selected @endif>その他</option>
            </select>
          </div>
        </div>
      </div>


      <div class="transition-button">
        <button type="submit" id="button">
          <span>この条件で絞り込む</span>
        </button>
      </div>
    </form>
  </div>

  @foreach($stCollection as $st)
  <div class="st-profile-wrapper">
    <div class="hr_profile_upper_wrapper flex">
      <div class="flex">
        <div class="left-child">
          <img class="st-photo" src="{{ asset($st['imagePath']) }}" alt="プロフィール写真">
        </div>
        <div class="right-child">
          <div>{{ $st['name'] }} ({{ $st['nickname'] }})</div>
          <div class="university_name">{{ $st['university'] }}（{{ $st['university_class'] }}）</div>
        </div>
      </div>
      <div class="interview_flag_wrapper">
        @if($st['status'] == 11)
          <div class="interview_flag">面接動画あり</div>
        @endif
      </div>
    </div>
    
    <div class="company-information-wrapper flex">
      <div class="company-industry">
        <img class="icon" src="{{ asset('/img/icon/industry.png') }}" alt="アイコン">
        <span class="company-information">{{ $st['industry'] }}</span>
      </div>
      <div class="company-location">
        <img class="icon" src="{{ asset('/img/icon/location.png') }}" alt="アイコン">
        <span>{{ $st['jobtype'] }}</span>
      </div>
      <div class="company-stock">
        <img class="icon" src="{{ asset('/img/icon/company_type.png') }}" alt="アイコン">
        <span>{{ $st['company_type'] }}</span>
      </div>
    </div>
    <div class="hr_profile_under_wrapper flex">
      <div>
        <a class="st-mypage" href="{{ route('hr.stpage', $st['id']) }}">{{ $st['name'] }}さんについて詳しく見る</a>
      </div>
      <div class="offer_button_wrapper">
        <a href="{{ route('hr.offer.form', $st['id']) }}"><span>スカウト</span></a>
      </div>
    </div>
  </div>
  @endforeach
</div>

<script type="text/javascript">
  let industries = @json($industries);
</script>
<script type="text/javascript" src="{{ asset('/js/hr/offer/search.js') }}"></script>
@endsection
