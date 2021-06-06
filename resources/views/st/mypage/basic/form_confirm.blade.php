@extends('layouts.st.common')
<link rel="stylesheet" href="{{ asset('css/st/mypage/basic/form_confirm.css') }}">
@section('content')
	@include('components.parts.page_title', ['title'=>'確認'])
	<div class="container form-wrapper">
	<form method="post" action="{{ route('mypage.basic.send') }}">
		@csrf
			@foreach($inputArray as $key => $input)
				<div class="form-input-wrapper">
					<label for="email" class="form-title">{{ $key }}</label>
					<div class="form-input">
						{{ $input }}
					</div>
				</div>
			@endforeach
			@include('components.parts.button.form.transition_button', ['text' => '変更'])
		</form>
	</div>
@endsection
