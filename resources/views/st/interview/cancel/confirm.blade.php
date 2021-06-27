@section('title', '面接のキャンセル')
<link rel="stylesheet" href="{{ asset('css/st/interview/cancel/confirm.css') }}">
@extends('layouts.st.common')
@section('content')

<div class="container form-wrapper">
	<div class="title">本当にキャンセルしますか？</div>
	<form method="post" action="{{ route('interview.cancel', $id) }}">
		@csrf
		<div class="upper-button">
			<a href="{{ route('mypage') }}">マイページに戻る</a>
		</div>
		<div class="button-wrapper">
			<button type="submit">
				キャンセルを確定する
			</button>
		</div>
	</form>
</div>
@endsection
