@extends('layouts.st.reverse')
<link href="{{ asset('/css/st/auth/main/register2.css') }}" rel="stylesheet">
@section('content')

  <div class="top-content-wrapper">
    <div class="top-content">
      <h1>STEP2</h1>
    </div>
  </div>

  @isset($message)
    <div class="card-body">
      {{$message}}
    </div>
  @endisset

  @empty($message)
    <div class="card-body form-wrapper">
      <form method="POST" action="{{ route('register3') }}">
      @csrf

      <div class="form-input-wrapper">
      <label for="university" class="form-title">大学名*</label>
        <div class="form-input flex">
          <input id="university" type="text" class="form-control {{ $errors->has('university') ? ' is-invalid' : '' }}" name="university" value="{{ old('university') }}" placeholder="面接大学" required>

          @if ($errors->has('university'))
            <span class="invalid-feedback">
              <strong>{{ $errors->first('university') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <div class="form-input-wrapper">
      <label for="faculty" class="form-title">学部名*</label>
        <div class="form-input flex">
          <input id="faculty" type="text" class="form-control {{ $errors->has('faculty') ? ' is-invalid' : '' }}" name="faculty" value="{{ old('faculty') }}" placeholder="面接学部" required>

          @if ($errors->has('faculty'))
            <span class="invalid-feedback">
              <strong>{{ $errors->first('faculty') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <div class="form-input-wrapper">
      <label for="department" class="form-title">学科名*</label>
        <div class="form-input flex">
          <input id="department" type="text" class="form-control {{ $errors->has('department') ? ' is-invalid' : '' }}" name="department" value="{{ old('department') }}" placeholder="面接学科" required>

          @if ($errors->has('department'))
            <span class="invalid-feedback">
              <strong>{{ $errors->first('department') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <div class="form-input-wrapper">
        <label for="graduate_year" class="form-title">卒業年度*</label>
        <div class="form-input">
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
        </div>
      </div>

      <div class="button-wrapper">
        <button type="submit">
          →
        </button>
      </div>
    </form>
  </div>
  @endempty

<script src="https://code.jquery.com/jquery-2.1.0.min.js" ></script>
@endsection
