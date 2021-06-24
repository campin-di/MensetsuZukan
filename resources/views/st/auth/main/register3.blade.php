@section('title', '就活情報の入力')
<link href="{{ asset('/css/st/auth/main/register3.css') }}" rel="stylesheet">
@extends('layouts.st.reverse')
@section('content')

@include('components.parts.page_title_reverse', ['title'=>'STEP3'])

  @isset($message)
    <div class="card-body">
      {{$message}}
    </div>
  @endisset

  @empty($message)
    <div class="card-body form-wrapper">
      <form method="POST" action="{{ route('register4') }}">
      @csrf

      <div class="form-input-wrapper">
        <label for="company_type" class="form-title">志望する企業タイプ*</label>
        <div class="form-input">
          <select id="company_type" class="form-control" name="company_type" required>
            <option value="">志望する企業タイプを選択してください。</option>
            @foreach($companyTypeArray as $company_type)
              <option value="{{ $company_type }}" @if(old('company_type') == "{{ $company_type }}") selected @endif>{{ $company_type }}</option>
            @endforeach
          </select>

          @if ($errors->has('company_type'))
            <span class="help-block">
              <strong>{{ $errors->first('company_type') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <div class="form-input-wrapper">
        <label for="industry" class="form-title">志望業界*</label>
        <div class="form-input">
          <select id="industry" class="form-control" name="industry" required>
            <option value="">志望業界を選択してください。</option>
            @foreach($industryArray as $industry)
              <option value="{{ $industry }}" @if(old('industry') == "{{ $industry }}") selected @endif>{{ $industry }}</option>
            @endforeach
          </select>
          @if ($errors->has('industry'))
            <span class="help-block">
              <strong>{{ $errors->first('industry') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <div class="form-input-wrapper">
        <label for="jobtype" class="form-title">志望職種*</label>
        <div class="form-input">
          <select id="jobtype" class="form-control" name="jobtype" required>
            <option value="">希望職種を選択してください。</option>
            @foreach($jobtypeArray as $jobtype)
              <option value="{{ $jobtype }}" @if(old('jobtype') == "{{ $jobtype }}") selected @endif>{{ $jobtype }}</option>
            @endforeach
          </select>
          @if ($errors->has('jobtype'))
            <span class="help-block">
              <strong>{{ $errors->first('jobtype') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <div class="form-input-wrapper">
        <label for="workplace" class="form-title">希望勤務地*</label>
        <div class="form-input">
          <select id="workplace" class="form-control" name="workplace" required>
            <option value="">希望勤務地を選択してください。</option>
            @foreach($prefecturesArray as $area => $prefectureArray)
              <optgroup label="{{ $area }}">
                @foreach($prefectureArray as $prefecture)
                  <option value="{{ $prefecture }}" @if(old('workplace') == "{{ $prefecture }}") selected @endif>{{ $prefecture }}</option>
                @endforeach
              </optgroup>
            @endforeach
          </select>
          @if ($errors->has('workplace'))
            <span class="help-block">
              <strong>{{ $errors->first('workplace') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <div class="form-input-wrapper">
        <label for="start_time" class="form-title">就活を開始したのはいつですか？*</label>
        <div class="form-input">
          <select id="start_time" class="form-control" name="start_time" required>
            <option value="">就活開始時期を選択してください。</option>
            @foreach($startTimeArray as $startTime)
              <option value="{{ $startTime }}" @if(old('start_time') == "{{ $startTime }}") selected @endif>{{ $startTime }}</option>
            @endforeach
          </select>
          @if ($errors->has('start_time'))
            <span class="help-block">
              <strong>{{ $errors->first('start_time') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <div class="form-input-wrapper">
        <label for="english_level" class="form-title">英語レベル*</label>
        <div class="form-input">
          <select id="english_level" class="form-control" name="english_level" required>
            <option value="">英語レベルを選択してください。</option>
            @foreach($englishLevelArray as $englishLevel)
              <option value="{{ $englishLevel }}" @if(old('english_level') == "{{ $englishLevel }}") selected @endif>{{ $englishLevel }}</option>
            @endforeach
          </select>
          @if ($errors->has('english_level'))
            <span class="help-block">
              <strong>{{ $errors->first('english_level') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <div class="form-input-wrapper">
        <label for="toeic" class="form-title">TOEICスコア*</label>
        <div class="form-input">
          <select id="toeic" class="form-control" name="toeic" required>
            <option value="">TOEICスコアを選択してください。</option>
            @foreach($toeicArray as $toeic)
              <option value="{{ $toeic }}" @if(old('toeic') == "{{ $toeic }}") selected @endif>{{ $toeic }}</option>
            @endforeach
          </select>
          @if ($errors->has('toeic'))
            <span class="help-block">
              <strong>{{ $errors->first('toeic') }}</strong>
            </span>
          @endif
        </div>
      </div>

      @include('components.parts.button.form.next_button')
    </form>
  </div>
  @endempty

<script src="https://code.jquery.com/jquery-2.1.0.min.js" ></script>
@endsection
