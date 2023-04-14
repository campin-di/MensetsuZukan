@section('title', '学生情報の入力')
<link href="{{ asset('/css/st/auth/main/register2.css') }}" rel="stylesheet">
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
      <form method="POST" action="{{ route('register3') }}">
      @csrf

      <div class="attention" style="margin: 10px 0 20px 10px;">
        <span class="asterisk" style="color: #6B8BE9;">*</span> は入力必須の項目です。
      </div>

      <div class="form-input-wrapper">
      <label for="university" class="form-title">大学/大学院名*</label>
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
      <label for="faculty" class="form-title">学部/研究科名*</label>
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
      <label for="department" class="form-title">学科/コース名*</label>
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
        <label for="major" class="form-title">文理区分*</label>
        <div class="form-input flex">
          <select id="major" class="form-control" name="major" required>
            <option value="">選択してください。</option>
            <option value="1" @if(old('major') == "1") selected @endif>文系</option>
            <option value="2" @if(old('major') == "2") selected @endif>理系</option>
          </select>
          @if ($errors->has('major'))
            <span class="invalid-feedback">
              <strong>{{ $errors->first('major') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <div class="form-input-wrapper">
        <label for="gymnasium" class="form-title">部活動*</label>
        <div class="form-input">
          <select id="gymnasium" class="form-control" name="gymnasium" required>
            <option value="">選択してください。</option>
              <option value="0" @if(old('gymnasium') == "0") selected @endif>体育会に所属している。</option>
              <option value="1" @if(old('gymnasium') == "1") selected @endif>体育会に所属していない。</option>
          </select>
          @if ($errors->has('gymnasium'))
            <span class="help-block">
              <strong>{{ $errors->first('gymnasium') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <div class="form-input-wrapper">
        <label for="birthplace" class="form-title">出身地</label>
        <div class="form-input">
          <select id="birthplace" class="form-control" name="birthplace" required>
            <option value="">選択してください。</option>
            @foreach($prefecturesArray as $area => $prefectureArray)
              @if($area != "▼ その他")
                <optgroup label="{{ $area }}">
                  @foreach($prefectureArray as $prefecture)
                    <option value="{{ $prefecture }}" @if(old('workplace') == "{{ $prefecture }}") selected @endif>{{ $prefecture }}</option>
                  @endforeach
                </optgroup>
              @endif
            @endforeach
            <option value="回答したくない。">回答したくない。</option>
          </select>
          @if ($errors->has('birthplace'))
            <span class="help-block">
              <strong>{{ $errors->first('birthplace') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <div class="form-input-wrapper">
        <label for="graduate_year" class="form-title">卒業年度*</label>
        <div class="form-input">
          <select id="graduate_year" class="form-control" name="graduate_year" required>
            <option value="">----</option>
            @for ($i = 2023; $i <= 2026; $i++)
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

      @include('components.parts.button.form.next_button')
    </form>
  </div>
  @endempty

<script src="https://code.jquery.com/jquery-2.1.0.min.js" ></script>
@endsection
