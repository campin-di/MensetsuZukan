@section('title', '動画のアップロード')
@extends('layouts.st.common')
@section('content')
<div class="container">
	<h3>フォーム</h3>
	@if ($errors->any())
	<div style="color:red;">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
	</div>
	@endif

	<form method="post" action="{{ route('form.post') }}">
		@csrf
		<table>
			<tr>
				<th height="75px">面接のID（interviews table）</th>
				<th class="right-block">
					<input type="text" name="interview_id" class="form-control" placeholder="IDを入力してください。">
				</th>
			</tr>
			<tr>
				<th height="75px">Vimeoの学生用動画ID</th>
				<th class="right-block">
					<input type="text" name="st_vimeo_id" class="form-control" placeholder="IDを入力してください。">
				</th>
			</tr>
			<tr>
				<th height="75px">Vimeoの人事用動画ID</th>
				<th class="right-block">
					<input type="text" name="hr_vimeo_id" class="form-control" placeholder="IDを入力してください。">
				</th>
			</tr>
		</table>
		<div class="next-button">
			<input type="hidden" name="question1_start" value="0:00">
			<input class="btn btn-primary" type="submit" value="送信" />
		</div>
	</form>
</div>
@endsection
