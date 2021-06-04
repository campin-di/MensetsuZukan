@extends('layouts.hr.common')
<link rel="stylesheet" href="{{ asset('css/st/mypage/basic/form_confirm.css') }}">
@section('content')
@include('components.parts.page_title', ['title'=>'確認'])
<form method="post" action="{{ route('hr.interview.schedule.send') }}">
	@csrf
	<div>
		@foreach($input['time'] as $time)
			<div class="form-input-wrapper">
				<label for="email" class="form-title">日程{{ $loop->iteration }}</label>
				<div class="form-input">
					{{ $input['date'] }} ： {{ $timeArray[$time] }}
				</div>
			</div>
		@endforeach
	</div>

	@include('components.parts.button.form.transition_button', ['text' => '追加'])
</form>
@endsection
