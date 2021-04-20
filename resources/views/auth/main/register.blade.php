@extends('layouts.common')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">本会員登録</div>

        @isset($message)
          <div class="card-body">
            {{$message}}
          </div>
        @endisset

        @empty($message)
        <div class="card-body">
          <form method="POST" action="{{ route('register.main.check', ['token' => $email_token]) }}">
          @csrf
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

          <div class="form-group row">
            <label for="graduate_year" class="col-md-4 col-form-label text-md-right">卒業年度</label>
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
              確認画面へ
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
