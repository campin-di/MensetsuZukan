@extends('layouts.hr.common')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">STEP１</div>

        @isset($message)
          <div class="card-body">
            {{$message}}
          </div>
        @endisset

        @empty($message)
        <div class="card-body">
          <form method="POST" action="{{ route('hr.register2') }}">
          @csrf
          <div class="form-group row">
            <label for="gender" class="col-md-4 col-form-label text-md-right">性別*</label>
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-6">
                  <select id="gender" class="form-control" name="gender">
                    <option value="1">男</option>
                    <option value="2">女</option>
                  </select>
                  @if ($errors->has('gender'))
                    <span class="help-block">
                      <strong>{{ $errors->first('gender') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label for="lastname" class="col-md-4 col-form-label text-md-right">氏名*</label>
            <div class="col-md-6">
              <input id="lastname" type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ old('lastname') }}" required>
              @if ($errors->has('lastname'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('lastname') }}</strong>
                </span>
              @endif

              <input id="firstname" type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{ old('firstname') }}" required>
              @if ($errors->has('firstname'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('firstname') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label for="kana_lastname" class="col-md-4 col-form-label text-md-right">フリガナ*</label>
            <div class="col-md-6">
              <input id="kana_lastname" type="text" class="form-control{{ $errors->has('kana_lastname') ? ' is-invalid' : '' }}" name="kana_lastname" value="{{ old('kana_lastname') }}" required>

              @if ($errors->has('kana_lastname'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('kana_lastname') }}</strong>
                </span>
              @endif

              <input id="kana_firstname" type="text" class="form-control{{ $errors->has('kana_firstname') ? ' is-invalid' : '' }}" name="kana_firstname" value="{{ old('kana_firstname') }}" required>

              @if ($errors->has('kana_firstname'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('kana_firstname') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <input type="hidden" name="email_verify_token" value="{{ $email_token }}" required>

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
