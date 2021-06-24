@section('title', '勤務情報の入力')
<link href="{{ asset('/css/st/auth/main/register3.css') }}" rel="stylesheet">
@extends('layouts.hr.reverse')
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

      <div class="form-input-wrapper">
      <label for="company" class="form-title">企業名*</label>
        <div class="form-input flex">
          <input id="company" type="text" class="form-control {{ $errors->has('company') ? ' is-invalid' : '' }}" name="company" value="{{ old('company') }}" placeholder="株式会社ぱむ" required>
          @if ($errors->has('company'))
            <span class="invalid-feedback">
              <strong>{{ $errors->first('company') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <div class="form-input-wrapper">
        <label for="industry" class="form-title">所属業界*</label>
        <div class="form-input">
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

      
      <div class="form-input-wrapper">
        <label for="company_type" class="form-title">企業区分*</label>
        <div class="form-input">
          <select id="company_type" class="form-control" name="company_type" required>
            <option value="">企業区分を選択してください。</option>
            @foreach($companyTypeArray as $company_type)
            <option value="{{ $company_type }}" @if(old('company_type') == "{{ $company_type }}") selected @endif>{{ $company_type }}</option>
            @endforeach
          </select>
          @if ($errors->has('company_type'))
          <span class="help-block">
            <strong>{{ $errors->first('company_type') }}</strong>
          </span>
          @endif
        </div>
      </div>
      
      
      <div class="form-input-wrapper">
        <label for="stock_type" class="form-title">上場区分*</label>
        <div class="form-input">
          <select id="stock_type" class="form-control" name="stock_type" required>
            <option value="">上場区分を選択してください。</option>
            @foreach($stockTypeArray as $stock_type)
            <option value="{{ $stock_type }}" @if(old('stock_type') == "{{ $stock_type }}") selected @endif>{{ $stock_type }}</option>
            @endforeach
          </select>
          @if ($errors->has('stock_type'))
          <span class="help-block">
            <strong>{{ $errors->first('stock_type') }}</strong>
          </span>
          @endif
        </div>
      </div>
      
      <div class="form-input-wrapper">
        <label for="location" class="form-title">本社所在地</label>
        <div class="form-input">
          <select id="location" class="form-control" name="location">
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
      
      @include('components.parts.button.form.next_button')
    </form>
  </div>
  @endempty

<script src="https://code.jquery.com/jquery-2.1.0.min.js" ></script>
@endsection
