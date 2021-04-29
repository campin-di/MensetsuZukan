@extends('layouts.common_hr')

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
          <form method="POST" action="{{ route('hr.register4') }}">
            @csrf

            <div class="form-group row">
              <label for="position" class="col-md-4 col-form-label text-md-right">役職</label>
              <div class="col-md-6">
                <input id="position" type="text" class="form-control{{ $errors->has('position') ? ' is-invalid' : '' }}" name="position" value="{{ old('position') }}" required>

                @if ($errors->has('position'))
                  <span class="invalid-feedback">
                    <strong>{{ $errors->first('position') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
            <label for="jobtype" class="col-md-4 col-form-label text-md-right">勤務地</label>
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
              <label for="summary" class="col-md-4 col-form-label text-md-right">事業概要</label>
              <div class="col-md-6">
                <input id="summary" type="text" class="form-control{{ $errors->has('summary') ? ' is-invalid' : '' }}" name="summary" value="{{ old('summary') }}" required>

                @if ($errors->has('summary'))
                  <span class="invalid-feedback">
                    <strong>{{ $errors->first('summary') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="recruitment" class="col-md-4 col-form-label text-md-right">募集要項URL</label>
              <div class="col-md-6">
                <input id="recruitment" type="text" class="form-control{{ $errors->has('recruitment') ? ' is-invalid' : '' }}" name="recruitment" value="{{ old('recruitment') }}" required>

                @if ($errors->has('recruitment'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('recruitment') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="site" class="col-md-4 col-form-label text-md-right">募集要項URL</label>
              <div class="col-md-6">
                <input id="site" type="text" class="form-control{{ $errors->has('site') ? ' is-invalid' : '' }}" name="site" value="{{ old('site') }}" required>

                @if ($errors->has('site'))
                  <span class="invalid-feedback">
                    <strong>{{ $errors->first('site') }}</strong>
                  </span>
                @endif
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
