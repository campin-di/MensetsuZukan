@section('title', '面接可能日を追加しました')
<link rel="stylesheet" href="{{ asset('css/st/mypage/basic/form_confirm.css') }}">
@extends('layouts.hr.common')
@section('content')
@include('components.parts.page_title', ['title'=>'確認'])
<form method="post" action="{{ route('hr.interview.schedule.deleteSend') }}">
	@csrf
	<div class="container">
		@foreach($scheduleArray as $date => $time)
			<div class="form-input-wrapper">
				<label for="email" class="form-title">削除する日程</label>
				<div class="form-input">
					{{ $date }} ： {{ $time }}
				</div>
			</div>
		@endforeach


		@include('components.parts.button.form.transition_button', ['text' => '送信'])
	</div>
</form>
@endsection
