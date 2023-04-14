@extends('layouts.hr.common')
<link rel="stylesheet" href="{{ asset('css/st/mypage/upload/form.css') }}">
@section('content')

	@include('components.parts.page_title', ['title'=>'プロフィール画像の編集'])

	@if ($errors->any())
		<div style="color:red;">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif


	<div class="container form-wrapper">
		<form method="post" action="{{ route('hr.mypage.basic.upload.post') }}" enctype="multipart/form-data">
			@csrf
			<div class="upload">
				<input type="file" name="image" accept="image/png, image/jpeg" />
			</div>
			<input type="hidden" name="id" value="{{ $id }}">

			@include('components.parts.button.form.transition_button', ['text'=>'アップロード'])
		</form>
	</div>
@endsection
