@extends('layouts.common')

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
          <form method="POST" action="{{ route('register2') }}">
          @csrf

          <div class="form-group row">
            <label for="gender" class="col-md-4 col-form-label text-md-right">性別</label>
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

              <div class="row col-md-6 col-md-offset-4">
                @if ($errors->has('graduate'))
                  <span class="help-block">
                    <strong>{{ $errors->first('graduate') }}</strong>
                  </span>
                @endif
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">名前</label>
            <div class="col-md-6">
              <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>

              @if ($errors->has('name'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('name') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label for="kana_name" class="col-md-4 col-form-label text-md-right">フリガナ</label>
            <div class="col-md-6">
              <input id="kana_name" type="text" class="form-control{{ $errors->has('kana_name') ? ' is-invalid' : '' }}" name="kana_name" value="{{ old('kana_name') }}" required>

              @if ($errors->has('kana_name'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('kana_name') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group row">
          <label for="username" class="col-md-4 col-form-label text-md-right">ユーザネーム</label>
            <div class="col-md-6">
              <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required>

              @if ($errors->has('username'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('username') }}</strong>
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
