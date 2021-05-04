@extends('layouts.common')

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
          <form method="POST" action="{{ route('register3') }}">
          @csrf

          <div class="form-group row">
            <label for="university" class="col-md-4 col-form-label text-md-right">大学名*</label>
            <div class="col-md-6">
              <input id="university" type="text" class="form-control{{ $errors->has('university') ? ' is-invalid' : '' }}" name="university" value="{{ old('university') }}" required>

              @if ($errors->has('university'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('university') }}</strong>
                </span>
              @endif
            </div>
          </div>
          <div class="form-group row">
            <label for="faculty" class="col-md-4 col-form-label text-md-right">学部名*</label>
            <div class="col-md-6">
              <input id="faculty" type="text" class="form-control{{ $errors->has('faculty') ? ' is-invalid' : '' }}" name="faculty" value="{{ old('faculty') }}" required>

              @if ($errors->has('faculty'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('faculty') }}</strong>
                </span>
              @endif
            </div>
          </div>
          <div class="form-group row">
            <label for="department" class="col-md-4 col-form-label text-md-right">学科名*</label>
            <div class="col-md-6">
              <input id="department" type="text" class="form-control{{ $errors->has('department') ? ' is-invalid' : '' }}" name="department" value="{{ old('department') }}" required>

              @if ($errors->has('department'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('department') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label for="graduate_year" class="col-md-4 col-form-label text-md-right">卒業年度*</label>
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-6">
                  <select id="graduate_year" class="form-control" name="graduate_year">
                    <option value="">----</option>
                    @for ($i = 2022; $i <= 2025; $i++)
                    <option value="{{ $i }}" @if(old('graduate_year') == $i) selected @endif>{{ $i }}</option>
                    @endfor
                  </select>
                  @if ($errors->has('graduate_year'))
                  <span class="help-block">
                    <strong>{{ $errors->first('graduate_year') }}</strong>
                  </span>
                  @endif
                </div>年卒
              </div>
              <div class="row col-md-6 col-md-offset-4">
                @if ($errors->has('graduate'))
                <span class="help-block">
                  <strong>{{ $errors->first('graduate') }}</strong>
                </span>
                @endif
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
