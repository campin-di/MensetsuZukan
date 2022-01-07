@section('title', '勤務情報の入力')
<link href="{{ asset('/css/st/auth/main/register3.css') }}" rel="stylesheet">
@extends('layouts.hr.reverse')
@section('content')

@include('components.parts.page_title_reverse', ['title'=>'STEP4'])


  @isset($message)
    <div class="card-body">
      {{$message}}
    </div>
  @endisset

  @empty($message)
    <div class="card-body form-wrapper">
    <form method="POST" action="{{ route('hr.register.main.post') }}">
      @csrf

      <div class="attention" style="margin: 10px 0 20px 10px;">
        <span class="asterisk" style="color: #6B8BE9;">*</span> は入力必須の項目です。
      </div>

      @if($plan == "面接官プラン")
        <div class="form-input-wrapper">
          <label for="selection_phase" class="form-title">普段担当している選考フェーズ *</label>
          <div class="form-input">
            <select id="selection_phase" class="form-control" name="selection_phase" required>
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

        <div class="form-input-wrapper">
          <label for="face" class="form-title">面接時に顔を公開したくありませんか？ *</label>
          <div class="form-input">
            <select id="face" class="form-control" name="face" required>
                <option value="1" @if(old('face') == "公開しても構わない") selected @endif>公開しても構わない</option>
                <option value="0" @if(old('face') == "公開できない（モザイク加工をして欲しい）") selected @endif>公開できない(モザイク加工をして欲しい)</option>
            </select>

            @if ($errors->has('face'))
              <span class="help-block">
                <strong>{{ $errors->first('face') }}</strong>
              </span>
            @endif
          </div>
        </div>
      @endif

      <div class="form-input-wrapper">
        <label for="workplace" class="form-title">
          主な勤務地
          @if($plan != "面接官プラン")*@endif
        </label>
        <div class="form-input">
          @if($plan == "面接官プラン")
            <select id="workplace" class="form-control" name="workplace">
          @else
            <select id="workplace" class="form-control" name="workplace" required>
          @endif
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

      <div class="form-input-wrapper">
      <label for="summary" class="form-title">
        事業概要
        @if($plan != "面接官プラン")*@endif
      </label>
        <div class="form-input flex">
          @if($plan == "面接官プラン")
            <textarea id="summary" type="text" rows="8" class="form-control {{ $errors->has('summary') ? ' is-invalid' : '' }}" name="summary" value="{{ old('summary') }}" placeholder="事業概要を入力してください。"></textarea>
          @else
            <textarea id="summary" type="text" rows="8" class="form-control {{ $errors->has('summary') ? ' is-invalid' : '' }}" name="summary" value="{{ old('summary') }}" placeholder="事業概要を入力してください。" required></textarea>
          @endif
          @if ($errors->has('summary'))
            <span class="invalid-feedback">
              <strong>{{ $errors->first('summary') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <div class="form-input-wrapper">
      <label for="site" class="form-title">企業ページURL</label>
        <div class="form-input flex">
          <input id="site" type="text" class="form-control {{ $errors->has('site') ? ' is-invalid' : '' }}" name="site" value="{{ old('site') }}" placeholder="URLを入力してください。">

          @if ($errors->has('site'))
            <span class="invalid-feedback">
              <strong>{{ $errors->first('site') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <div class="form-input-wrapper">
      <label for="recruitment" class="form-title">採用ページURL</label>
        <div class="form-input flex">
          <input id="recruitment" type="text" class="form-control {{ $errors->has('recruitment') ? ' is-invalid' : '' }}" name="recruitment" value="{{ old('recruitment') }}" placeholder="URLを入力してください。">

          @if ($errors->has('recruitment'))
            <span class="invalid-feedback">
              <strong>{{ $errors->first('recruitment') }}</strong>
            </span>
          @endif
        </div>
      </div>
      @include('components.parts.button.form.next_button')
    </form>
  </div>
  @endempty

<script src="https://code.jquery.com/jquery-2.1.0.min.js" ></script>
@endsection
