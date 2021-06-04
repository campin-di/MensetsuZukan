@extends('layouts.hr.common')
<link href="{{ asset('/css/st/mypage/detail/step2.css') }}" rel="stylesheet">
@section('content')

@include('components.parts.page_title', ['title'=>'STEP2'])

@isset($message)
	<div class="card-body">
		{{$message}}
	</div>
@endisset

<div class="container form-wrapper">
	<form method="post" action="{{ route('hr.mypage.detail.post') }}">
		@csrf
		<div class="form-input-wrapper">
			<label for="introduction" class="form-title">簡単な自己紹介</label>
			<div class="form-input">
				<textarea name="introduction" rows="4" cols="40" placeholder="ここに入力してください。">{{ $userData->introduction }}</textarea>
				@if ($errors->has('introduction'))
					<span class="help-block">
						<strong>{{ $errors->first('introduction') }}</strong>
					</span>
				@endif
			</div>
		</div>

		<div class="form-input-wrapper">
			<label for="pr" class="form-title">面接官PR</label>
			<div class="form-input">
				<textarea name="pr" rows="4" cols="40" placeholder="ここに入力してください。">{{ $userData->pr }}</textarea>
				@if ($errors->has('pr'))
					<span class="help-block">
						<strong>{{ $errors->first('pr') }}</strong>
					</span>
				@endif
			</div>
		</div>

		@include('components.parts.button.form.next_button')
	</form>
</div>
@endsection
