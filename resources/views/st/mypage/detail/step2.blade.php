@section('title', '登録情報の変更')
<link href="{{ asset('/css/st/mypage/detail/step2.css') }}" rel="stylesheet">
@extends('layouts.st.common')
@section('content')

@include('components.parts.page_title', ['title'=>'STEP2'])

@isset($message)
	<div class="card-body">
		{{$message}}
	</div>
@endisset

<div class="container form-wrapper">
	<form method="post" action="{{ route('mypage.detail.post') }}">
		@csrf

		<div class="form-input-wrapper">
			<label for="introduction" class="form-title">簡単な自己紹介</label>
			<div class="form-input">
				<textarea name="introduction" rows="4" cols="40" placeholder="ここに入力してください。">{{ $userData->introduction }}</textarea required>
				@if ($errors->has('introduction'))
					<span class="help-block">
						<strong>{{ $errors->first('introduction') }}</strong>
					</span>
				@endif
			</div>
		</div>

		<div class="form-input-wrapper">
			<label for="strengths" class="form-title">自分の強み</label>
			<div class="form-input">
				<textarea name="strengths" rows="4" cols="40" placeholder="ここに入力してください。" required>{{ $userData->strengths }}</textarea>
				@if ($errors->has('strengths'))
					<span class="help-block">
						<strong>{{ $errors->first('strengths') }}</strong>
					</span>
				@endif
			</div>
		</div>

		<div class="form-input-wrapper">
			<label for="gakuchika" class="form-title">ガクチカ</label>
			<div class="form-input">
				<textarea name="gakuchika" rows="4" cols="40" placeholder="ここに入力してください。" required>{{ $userData->gakuchika }}</textarea>
				@if ($errors->has('gakuchika'))
					<span class="help-block">
						<strong>{{ $errors->first('gakuchika') }}</strong>
					</span>
				@endif
			</div>
		</div>

		<div class="form-input-wrapper">
			<label for="personality" class="form-title">自分の性格</label>
			<div class="form-input">
				<textarea name="personality" rows="4" cols="40" placeholder="ここに入力してください。" required>{{ $userData->personality }}</textarea>
				@if ($errors->has('personality'))
					<span class="help-block">
						<strong>{{ $errors->first('personality') }}</strong>
					</span>
				@endif
			</div>
		</div>

		<div class="form-input-wrapper">
			<label for="other_language" class="form-title">英語以外の言語使用経験</label>
			<div class="form-input">
				<textarea name="other_language" rows="4" cols="40" placeholder="ここに入力してください。" required>{{ $userData->other_language }}</textarea>
				@if ($errors->has('other_language'))
					<span class="help-block">
						<strong>{{ $errors->first('other_language') }}</strong>
					</span>
				@endif
			</div>
		</div>

		<div class="form-input-wrapper">
			<label for="qualification" class="form-title">資格・受賞歴等</label>
			<div class="form-input">
				<textarea name="qualification" rows="4" cols="40" placeholder="ここに入力してください。" required>{{ $userData->qualification }}</textarea>
				@if ($errors->has('qualification'))
					<span class="help-block">
						<strong>{{ $errors->first('qualification') }}</strong>
					</span>
				@endif
			</div>
		</div>

		@include('components.parts.button.form.next_button')
	</form>
</div>
@endsection
