@extends('layouts.common')

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
                      <option value="IT" @if(old('industry') == "IT") selected @endif>IT</option>
                      <option value="食品" @if(old('industry') == "食品") selected @endif>食品</option>
                      <option value="人材" @if(old('industry') == "人材") selected @endif>人材</option>
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
                      <option value="技術職" @if(old('jobtype') == "技術職") selected @endif>技術職</option>
                      <option value="事務職" @if(old('jobtype') == "事務職") selected @endif>事務職</option>
                    </select>
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
            <label for="jobtype" class="col-md-4 col-form-label text-md-right">志望勤務地</label>
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-6">
                    <select id="workplace" class="form-control" name="workplace">
                      <option value="">勤務地を選択してください。</option>
                      <option value="東京都" @if(old('workplace') == "東京都") selected @endif>東京都</option>
                      <option value="大阪府" @if(old('workplace') == "大阪府") selected @endif>大阪府</option>
                      <option value="福岡県" @if(old('workplace') == "福岡県") selected @endif>福岡県</option>
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
            <label for="start_time" class="col-md-4 col-form-label text-md-right">就活を開始したのはいつですか？</label>
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-6">
                    <select id="start_time" class="form-control" name="start_time">
                      <option value="">選択してください。</option>
                      <option value="それ以前" @if(old('start_time') == "それ以前") selected @endif>それ以前</option>
                      <option value="大学3年生前期" @if(old('start_time') == "大学3年生前期") selected @endif>大学3年生前期</option>
                      <option value="大学3年生後期" @if(old('start_time') == "大学3年生後期") selected @endif>大学3年生後期</option>
                      <option value="それ以降" @if(old('start_time') == "それ以降") selected @endif>それ以降</option>
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