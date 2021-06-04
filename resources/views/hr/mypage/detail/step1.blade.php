@extends('layouts.hr.common')
<link href="{{ asset('/css/st/mypage/detail/step1.css') }}" rel="stylesheet">
@section('content')

@include('components.parts.page_title', ['title'=>'STEP1'])

@isset($message)
	<div class="card-body">
		{{$message}}
	</div>
@endisset

<div class="container form-wrapper">
	<form method="post" action="{{ route('hr.mypage.detail.step2') }}">
		@csrf

		<div class="form-input-wrapper">
			<label for="location" class="form-title">本社所在地*</label>
			<div class="form-input">
				<select id="location" class="form-control" name="location" required>
					<option value="{{ $userData->location }}">{{ $userData->location }}</option>
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

		<div class="form-input-wrapper">
			<label for="workplace" class="form-title">主な勤務地*</label>
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
			<label for="company_type" class="form-title">企業区分*</label>
			<div class="form-input">
				<select id="company_type" class="form-control" name="company_type" required>
					<option value="{{ $userData->company_type }}">{{ $userData->company_type }}</option>
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
					<option value="{{ $userData->stock_type }}">{{ $userData->stock_type }}</option>
					@foreach($companyTypeArray as $stock_type)
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
		<label for="summary" class="form-title">事業概要</label>
			<div class="form-input flex">
				<input id="summary" type="text" class="form-control {{ $errors->has('summary') ? ' is-invalid' : '' }}" name="summary" value="{{ $userData->summary }}" placeholder="事業概要を入力してください。">

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
				<input id="site" type="text" class="form-control {{ $errors->has('site') ? ' is-invalid' : '' }}" name="site" value="{{ $userData->site }}" placeholder="URLを入力してください。">

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
				<input id="recruitment" type="text" class="form-control {{ $errors->has('recruitment') ? ' is-invalid' : '' }}" name="recruitment" value="{{ $userData->recruitment }}" placeholder="URLを入力してください。">

				@if ($errors->has('recruitment'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('recruitment') }}</strong>
					</span>
				@endif
			</div>
		</div>

		<div class="form-input-wrapper">
			<label for="selection_phase" class="form-title">普段担当する選考フェーズ</label>
			<div class="form-input">
				<select id="selection_phase" class="form-control" name="selection_phase">
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

		@include('components.parts.button.form.next_button')
	</form>
</div>
@endsection
