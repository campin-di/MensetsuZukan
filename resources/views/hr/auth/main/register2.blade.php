@extends('layouts.common_hr')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">STEP2</div>

        @isset($message)
          <div class="card-body">
            {{$message}}
          </div>
        @endisset

        @empty($message)
        <div class="card-body">
          <form method="POST" action="{{ route('hr.register3') }}">
          @csrf

          <div class="form-group row">
            <label for="company" class="col-md-4 col-form-label text-md-right">企業名*</label>
            <div class="col-md-6">
              <input id="company" type="text" class="form-control{{ $errors->has('company') ? ' is-invalid' : '' }}" name="company" value="{{ old('company') }}" placeholder="例：株式会社ぱむ" required>

              @if ($errors->has('company'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('company') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group row">
          <label for="industry" class="col-md-4 col-form-label text-md-right">所属業界*</label>
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-6">
                  <select id="industry" class="form-control" name="industry" required>
                    <option value="">所属企業の業界を選択してください。</option>
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
          <label for="location" class="col-md-4 col-form-label text-md-right">本社所在地*</label>
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-6">
                  <select id="location" class="form-control" name="location" required>
                    <option value="">本社所在地を選択してください。</option>
                    @foreach($prefecturesArray as $area => $prefectureArray)
                      <optgroup label="{{ $area }}">
                        @foreach($prefectureArray as $prefecture)
                          <option value="{{ $prefecture }}" @if(old('location') == "{{ $prefecture }}") selected @endif>{{ $prefecture }}</option>
                        @endforeach
                      </optgroup>
                    @endforeach
                  </select>
                  @if ($errors->has('location'))
                    <span class="help-block">
                      <strong>{{ $errors->first('location') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
            </div>
          </div>

          <div class="form-group row">
          <label for="company_type" class="col-md-4 col-form-label text-md-right">企業区分*</label>
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-6">
                  <select id="company_type" class="form-control" name="company_type" required>
                    <option value="">属する企業区分を選択してください。</option>
                    <option value="東証一部" @if(old('company_type') == "東証一部") selected @endif>東証一部</option>
                    <option value="マザーズ" @if(old('company_type') == "マザーズ") selected @endif>マザーズ</option>
                    <option value="未上場" @if(old('company_type') == "未上場") selected @endif>未上場</option>
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
