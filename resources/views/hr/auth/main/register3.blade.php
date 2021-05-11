@extends('layouts.hr.common')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">STEP3</div>

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
            <label for="selection_phase" class="col-md-4 col-form-label text-md-right">普段担当する選考フェーズ</label>
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-6">
                    <select id="selection_phase" class="form-control" name="selection_phase">
                      @foreach($selectionPhaseArray as $phase)
                        <option value="{{ $phase }}" @if(old('selection_phase') == "{{ $phase }}") selected @endif>{{ $phase }}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('selection_phase'))
                      <span class="help-block">
                        <strong>{{ $errors->first('selection_phase') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group row">
            <label for="workplace" class="col-md-4 col-form-label text-md-right">主な勤務地</label>
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-6">
                    <select id="workplace" class="form-control" name="workplace">
                      <option value="">主な勤務地を選択してください。</option>
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
              <label for="summary" class="col-md-4 col-form-label text-md-right">事業概要</label>
              <div class="col-md-6">
                <input id="summary" type="text" class="form-control{{ $errors->has('summary') ? ' is-invalid' : '' }}" name="summary" value="{{ old('summary') }}">

                @if ($errors->has('summary'))
                  <span class="invalid-feedback">
                    <strong>{{ $errors->first('summary') }}</strong>
                  </span>
                @endif
              </div>
            </div>


            <div class="form-group row">
              <label for="site" class="col-md-4 col-form-label text-md-right">企業ページURL</label>
              <div class="col-md-6">
                <input id="site" type="text" class="form-control{{ $errors->has('site') ? ' is-invalid' : '' }}" name="site" value="{{ old('site') }}">

                @if ($errors->has('site'))
                  <span class="invalid-feedback">
                    <strong>{{ $errors->first('site') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="recruitment" class="col-md-4 col-form-label text-md-right">募集要項URL</label>
              <div class="col-md-6">
                <input id="recruitment" type="text" class="form-control{{ $errors->has('recruitment') ? ' is-invalid' : '' }}" name="recruitment" value="{{ old('recruitment') }}">

                @if ($errors->has('recruitment'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('recruitment') }}</strong>
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
