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
				<th height="75px"> 学生用動画のID</th>
				<th class="right-block">
					<input type="text" name="st_video_id" class="form-control" placeholder="IDを入力してください。">
				</th>
			</tr>
			<tr>
				<th height="75px"> 人事用動画のID</th>
				<th class="right-block">
					<input type="text" name="hr_video_id" class="form-control" placeholder="IDを入力してください。">
				</th>
			</tr>
			<tr>
				<th height="75px">Vimeoの学生用動画URL</th>
				<th class="right-block">
					<input type="text" name="st_vimeo_url" class="form-control" placeholder="IDを入力してください。">
				</th>
			</tr>
			<tr>
				<th height="75px">Vimeoの人事用動画URL</th>
				<th class="right-block">
					<input type="text" name="hr_vimeo_url" class="form-control" placeholder="IDを入力してください。">
				</th>
			</tr>
		</table>
		<div class="next-button">
			<input class="btn btn-primary" type="submit" value="送信" />
		</div>
	</form>
</div>
@endsection
