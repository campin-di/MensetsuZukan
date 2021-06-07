@extends('layouts.hr.common')
<link rel="stylesheet" href="{{ asset('css/st/mypage/basic/form.css') }}">
@section('content')

	@include('components.parts.page_title', ['title'=>'基本情報の変更'])

	<div class="container">
		@if ($errors->any())
		<div style="color:red;">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif

		<div class="container_profile">
			<div class="container_profile_img_wrapper">
				<img id="profile_img" class="container_profile_img" src="{{ asset($userData->image_path) }}" alt="プロフィール画像">
				<a href="{{ route('hr.mypage.basic.upload', $userData->id) }}" class="mask">
					<div class="caption">編集</div>
				</a>
			</div>
			<p class="container_profile_name">
				{{ $userData->name }}
				{{ $userData->nickname }}
			</p>
		</div>

		<form method="post" action="{{ route('hr.mypage.basic.post') }}">
			@csrf

			<div class="form-input-wrapper">
				<label for="password" class="form-title">パスワード</label>
				<span id="edit_password">(編集)</span>
				<div class="form-input">
					<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" disabled placeholder="*********" autocomplete="current-password">
					@error('password')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
			</div>

			@include('components.parts.button.form.next_button')
		</form>
	</div>
	<script type="text/javascript" src="{{ asset('/js/hr/mypage/basic/form.js') }}"></script>
@endsection