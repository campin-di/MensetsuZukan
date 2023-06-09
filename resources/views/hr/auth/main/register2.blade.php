@section('title', '基本情報の入力')
<link href="{{ asset('/css/st/auth/main/register.css') }}" rel="stylesheet">
@extends('layouts.st.reverse')
@section('content')

  @include('components.parts.page_title_reverse', ['title'=>'STEP2'])

  @isset($message)
    <div class="card-body">
      {{$message}}
    </div>
  @endisset

  @empty($message)
    <div class="card-body form-wrapper">
      <form method="POST" action="{{ route('hr.register3') }}">
      @csrf

      <div class="attention" style="margin: 10px 0 20px 10px;">
        <span class="asterisk" style="color: #6B8BE9;">*</span> は入力必須の項目です。
      </div>
      
      @if($plan == "面接官プラン")
        <div class="form-input-wrapper">
          <label for="gender" class="form-title">性別*</label>
          <div class="form-input">
            <select id="gender" class="form-control" name="gender">
              <option value="">性別を選択してください。</option>
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
      @endif

      <div class="form-input-wrapper">
        <label for="lastname" class="form-title">
        @if($plan == "面接官プラン")  氏名* @else 社名* @endif
        </label>
        <div class="form-input flex">
          <div class="form-left-child">
            @if($plan == "面接官プラン")
              <input id="lastname" type="text" class="form-control {{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ old('lastname') }}" placeholder="姓" required>
            @else
              <input id="lastname" type="text" class="form-control {{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ old('lastname') }}" placeholder="株式会社（PAM）" required> 
            @endif
            @if ($errors->has('lastname'))
            <span class="invalid-feedback">
              <strong>{{ $errors->first('lastname') }}</strong>
            </span>
            @endif
          </div>
          <div class="form-right-child">
            @if($plan == "面接官プラン")
              <input id="firstname" type="text" class="form-control {{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{ old('firstname') }}" placeholder="名" required>
            @else
              <input id="firstname" type="text" class="form-control {{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{ old('firstname') }}" placeholder="PAM（株式会社）" required>
            @endif
            @if ($errors->has('firstname'))
            <span class="invalid-feedback">
              <strong>{{ $errors->first('firstname') }}</strong>
            </span>
            @endif
          </div>
        </div>
      </div>
      
      @if($plan == "面接官プラン")
        <div class="form-input-wrapper">
          <label for="kana_lastname" class="form-title">フリガナ*</label>
          <div class="form-input flex">
            <div class="form-left-child">
              <input id="kana_lastname" type="text" class="form-control{{ $errors->has('kana_lastname') ? ' is-invalid' : '' }}" name="kana_lastname" value="{{ old('kana_lastname') }}" placeholder="セイ" required>
              @if ($errors->has('kana_lastname'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('kana_lastname') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-right-child">
              <input id="kana_firstname" type="text" class="form-control{{ $errors->has('kana_firstname') ? ' is-invalid' : '' }}" name="kana_firstname" value="{{ old('kana_firstname') }}" placeholder="メイ" required>
              @if ($errors->has('kana_firstname'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('kana_firstname') }}</strong>
                </span>
              @endif
            </div>
          </div>
        </div>

        <div class="form-input-wrapper">
        <label for="nickname" class="form-title">ニックネーム*</label>
          <div class="form-input flex">
            <input id="nickname" type="text" class="form-control {{ $errors->has('nickname') ? ' is-invalid' : '' }}" name="nickname" value="{{ old('nickname') }}" placeholder="例：よっしー" required>

            @if ($errors->has('nickname'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('nickname') }}</strong>
              </span>
            @endif
          </div>
        </div>
      @endif

      <input type="hidden" id="plan" class="button" name="plan" value="{{ $plan }}" required>
      @include('components.parts.button.form.next_button')
    </form>
  </div>
  @endempty

<script src="https://code.jquery.com/jquery-2.1.0.min.js" ></script>
@endsection
