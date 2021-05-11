@extends('layouts.st.common')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">STEP３</div>

        @isset($message)
          <div class="card-body">
            {{$message}}
          </div>
        @endisset

        @empty($message)
        <div class="card-body">
          <form method="POST" action="{{ route('register4') }}">
            @csrf

            <div class="form-group row">
            <label for="company_type" class="col-md-4 col-form-label text-md-right">志望する企業タイプ*</label>
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-6">
                    <select id="company_type" class="form-control" name="company_type" required>
                      <option value="">志望する企業タイプを選択してください。</option>
                      <option value="大手" @if(old('company_type') == "大手") selected @endif>大手</option>
                      <option value="老舗" @if(old('company_type') == "老舗") selected @endif>老舗</option>
                      <option value="ベンチャー" @if(old('company_type') == "ベンチャー") selected @endif>ベンチャー</option>
                    </select>
                    @if ($errors->has('company_type'))
                      <span class="help-block">
                        <strong>{{ $errors->first('company_type') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group row">
            <label for="industry" class="col-md-4 col-form-label text-md-right">志望業界*</label>
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-6">
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
              </div>
            </div>

            <div class="form-group row">
            <label for="jobtype" class="col-md-4 col-form-label text-md-right">志望職種*</label>
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-6">
                    <select id="jobtype" class="form-control" name="jobtype" required>
                      <option value="">希望職種を選択してください。</option>
                      <option value="営業職" @if(old('jobtype') == "営業職") selected @endif>営業職</option>
                      @foreach($jobtypeArray as $jobtype)
                        <option value="{{ $jobtype }}" @if(old('jobtype') == "{{ $jobtype }}") selected @endif>{{ $jobtype }}</option>
                      @endforeach                    </select>
                    @if ($errors->has('jobtype'))
                      <span class="help-block">
                        <strong>{{ $errors->first('jobtype') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group row">
            <label for="workplace" class="col-md-4 col-form-label text-md-right">志望勤務地*</label>
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-6">
                    <select id="workplace" class="form-control" name="workplace" required>
                      <option value="">勤務地を選択してください。</option>
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
              </div>
            </div>

            <div class="form-group row">
            <label for="start_time" class="col-md-4 col-form-label text-md-right">就活を開始したのはいつですか？*</label>
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-6">
                    <select id="start_time" class="form-control" name="start_time">
                      <option value="">選択してください。</option>
                      <option value="直近1ヶ月以内" @if(old('start_time') == "直近1ヶ月以内") selected @endif>直近1ヶ月以内</option>
                      <option value="直近3ヶ月以内" @if(old('start_time') == "直近3ヶ月以内") selected @endif>直近3ヶ月以内</option>
                      <option value="半年以内" @if(old('start_time') == "半年以内") selected @endif>半年以内</option>
                      <option value="1年以内" @if(old('start_time') == "1年以内") selected @endif>1年以内</option>
                      <option value="1年半以内" @if(old('start_time') == "1年半以内") selected @endif>1年半以内</option>
                      <option value="2年以内" @if(old('start_time') == "2年以内") selected @endif>2年以内</option>
                      <option value="2年以前" @if(old('start_time') == "2年以前") selected @endif>2年以前</option>
                    </select>
                    @if ($errors->has('start_time'))
                      <span class="help-block">
                        <strong>{{ $errors->first('start_time') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group row">
            <label for="english" class="col-md-4 col-form-label text-md-right">英語レベル*</label>
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-6">
                    <select id="english" class="form-control" name="english" required>
                      <option value="">英語レベルを選択してください。</option>
                      <option value="日常会話レベル" @if(old('english') == "日常会話レベル") selected @endif>日常会話レベル</option>
                      <option value="ディベートレベル" @if(old('english') == "ディベートレベル") selected @endif>ディベートレベル</option>
                      <option value="ビジネスレベル" @if(old('english') == "ビジネスレベル") selected @endif>ビジネスレベル</option>
                      <option value="ネイティブレベル" @if(old('english') == "ネイティブレベル") selected @endif>ネイティブレベル</option>
                    </select>
                    @if ($errors->has('english'))
                      <span class="help-block">
                        <strong>{{ $errors->first('english') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group row">
            <label for="toeic" class="col-md-4 col-form-label text-md-right">TOEICスコア*</label>
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-6">
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
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                　→　
                </button>
              </div>
            </div>
            </form>
          </div>
        @endempty
      </div>
    </div>
  </div>
</div>
@endsection
