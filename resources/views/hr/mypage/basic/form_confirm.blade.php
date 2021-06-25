@section('title', '変更内容の確認')
<link rel="stylesheet" href="{{ asset('css/st/mypage/basic/form_confirm.css') }}">
@extends('layouts.hr.common')
@section('content')
	@include('components.parts.page_title', ['title'=>'確認'])
	<form method="post" action="{{ route('hr.mypage.basic.send') }}">
		@csrf
		<div>
			@foreach($inputArray as $key => $input)
				<div class="form-input-wrapper">
					<label for="email" class="form-title">{{ $key }}</label>
					<div class="form-input">
						{{ $input }}
					</div>
				</div>
			@endforeach
		</div>

		@include('components.parts.button.form.transition_button', ['text' => '変更'])
	</form>
@endsection
