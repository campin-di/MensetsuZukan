@section('title', '登録情報の変更')
<link href="{{ asset('/css/st/mypage/detail/step1.css') }}" rel="stylesheet">
@extends('layouts.st.common')
@section('content')

@include('components.parts.page_title', ['title'=>'STEP1'])
@isset($message)
	<div class="card-body">
		{{$message}}
	</div>
@endisset

<div class="container form-wrapper">
	<!--研究室登録フォーム-->
	<form method="post" action="{{ route('mypage.detail.step2') }}">
		@csrf

		<div class="form-input-wrapper">
			<label for="company_type" class="form-title">志望する企業タイプ*</label>
			<div class="form-input">
				<select id="company_type" class="form-control" name="company_type" required>
					<option value="{{ $userData->company_type }}">{{ $userData->company_type }}</option>
					<option value="大手" @if(old('company_type') == "大手") selected @endif>大手（安定・着実、会社の規模が大きい）</option>
					<option value="中小" @if(old('company_type') == "中小") selected @endif>中小（安定・着実、会社の規模が小さい）</option>
					<option value="メガベンチャー" @if(old('company_type') == "メガベンチャー") selected @endif>メガベンチャー（挑戦・成長、会社の規模が大きい）</option>
					<option value="ベンチャー" @if(old('company_type') == "ベンチャー") selected @endif>ベンチャー（挑戦・成長、会社の規模が小さい）</option>
				</select>

				@if ($errors->has('company_type'))
					<span class="help-block">
						<strong>{{ $errors->first('company_type') }}</strong>
					</span>
				@endif
			</div>
		</div>

		<div class="form-input-wrapper">
			<label for="industry" class="form-title">志望業界*</label>
			<div class="form-input">
				<select id="industry" class="form-control" name="industry" required>
					<option value="{{ $userData->industry }}">{{ $userData->industry }}</option>
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
			<label for="jobtype" class="form-title">志望職種*</label>
			<div class="form-input">
				<select id="jobtype" class="form-control" name="jobtype" required>
					<option value="{{ $userData->jobtype }}">{{ $userData->jobtype }}</option>
					<option value="営業職" @if(old('jobtype') == "営業職") selected @endif>営業職</option>
					@foreach($jobtypeArray as $jobtype)
						<option value="{{ $jobtype }}" @if(old('jobtype') == "{{ $jobtype }}") selected @endif>{{ $jobtype }}</option>
					@endforeach
				</select>
				@if ($errors->has('jobtype'))
					<span class="help-block">
						<strong>{{ $errors->first('jobtype') }}</strong>
					</span>
				@endif
			</div>
		</div>

		<div class="form-input-wrapper">
			<label for="workplace" class="form-title">希望勤務地*</label>
			<div class="form-input">
				<select id="workplace" class="form-control" name="workplace" required>
					<option value="{{ $userData->workplace }}">{{ $userData->workplace }}</option>
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
			<label for="start_time" class="form-title">就活を開始したのはいつですか？*</label>
			<div class="form-input">
				<select id="start_time" class="form-control" name="start_time" required>
					<option value="{{ $userData->start_time }}">{{ $userData->start_time }}</option>
					<option value="直近1ヶ月以内" @if(old('start_time') == "直近1ヶ月以内") selected @endif>直近1ヶ月以内</option>
					<option value="直近3ヶ月以内" @if(old('start_time') == "直近3ヶ月以内") selected @endif>直近3ヶ月以内</option>
					<option value="半年以内" @if(old('start_time') == "半年以内") selected @endif>半年以内</option>
					<option value="1年以内" @if(old('start_time') == "1年以内") selected @endif>1年以内</option>
					<option value="1年半以内" @if(old('start_time') == "1年半以内") selected @endif>1年半以内</option>
					<option value="2年以内" @if(old('start_time') == "2年以内") selected @endif>2年以内</option>
					<option value="2年以前" @if(old('start_time') == "2年以前") selected @endif>2年以前</option>
				</select>
				@if ($errors->has('start_time'))
					<span class="help-block">
						<strong>{{ $errors->first('start_time') }}</strong>
					</span>
				@endif
			</div>
		</div>

		<div class="form-input-wrapper">
			<label for="english_level" class="form-title">英語レベル*</label>
			<div class="form-input">
				<select id="english_level" class="form-control" name="english_level" required>
					<option value="{{ $userData->english_level }}">{{ $userData->english_level }}</option>
					<option value="日常会話レベル" @if(old('english_level') == "日常会話レベル") selected @endif>日常会話レベル</option>
					<option value="ディベートレベル" @if(old('english_level') == "ディベートレベル") selected @endif>ディベートレベル</option>
					<option value="ビジネスレベル" @if(old('english_level') == "ビジネスレベル") selected @endif>ビジネスレベル</option>
					<option value="ネイティブレベル" @if(old('english_level') == "ネイティブレベル") selected @endif>ネイティブレベル</option>
				</select>
				@if ($errors->has('english_level'))
					<span class="help-block">
						<strong>{{ $errors->first('english_level') }}</strong>
					</span>
				@endif
			</div>
		</div>

		<div class="form-input-wrapper">
			<label for="toeic" class="form-title">TOEICスコア*</label>
			<div class="form-input">
				<select id="toeic" class="form-control" name="toeic" required>
					<option value="{{ $userData->toeic }}">{{ $userData->toeic }}</option>
					@foreach($toeicArray as $toeic)
						<option value="{{ $toeic }}" @if(old('toeic') == "{{ $toeic }}") selected @endif>{{ $toeic }}</option>
					@endforeach
				</select>
				@if ($errors->has('toeic'))
					<span class="help-block">
						<strong>{{ $errors->first('toeic') }}</strong>
					</span>
				@endif
			</div>
		</div>
		@include('components.parts.button.form.next_button')

	</form>
</div>
@endsection
