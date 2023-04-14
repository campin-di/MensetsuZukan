@section('title', 'LINE通知')
@extends('layouts.st.common')
@section('content')
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

	<form method="post" action="{{ route('notification.confirm') }}">
		@csrf
		<table>
			<tr>
				<th height="75px"> 学生ID</th>
				<th class="right-block">
					<input type="text" name="ids" class="form-control" placeholder="IDを入力してください。">
				</th>
			</tr>
			<tr>
				<th height="75px">通知内容</th>
				<th class="right-block">
					<textarea type="text" name="message" class="form-control" placeholder="通知メッセージを入力してください。"></textarea>
				</th>
			</tr>
		</table>
    	@include('components.parts.button.form.transition_button', ['text' => '送信する'])
	</form>
</div>

@include('components.parts.button.transition_button', ['routeName' => 'notification.event', 'text' => 'イベント告知を行う', 'var' => ''])

@endsection
