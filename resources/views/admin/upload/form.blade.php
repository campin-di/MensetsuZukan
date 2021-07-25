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

	<!--研究室登録フォーム-->
	<form method="post" action="{{ route('form.post') }}">
		@csrf
		<table>
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
			<!--
			<tr>
				<th height="75px">サムネイルの画像パス</th>
				<th class="right-block">
					<input type="text" name="thumbnail_src" class="form-control" placeholder="画像をアップロードしてください。">
				</th>
			</tr>
			-->
			<tr>
				<th height="75px">面接のID（interviews table）</th>
				<th class="right-block">
					<input type="text" name="interview_id" class="form-control" placeholder="IDを入力してください。">
				</th>
			</tr>

			<tr>
				<th height="75px">1番目の質問の開始時間（s）</th>
				<th class="right-block">
					<input type="number" name="start_time_1" class="form-control" placeholder="秒に変換して入力してください。">
				</th>
			</tr>
			<tr>
				<th height="75px">2番目の質問の開始時間（s）</th>
				<th class="right-block">
					<input type="number" name="start_time_2" class="form-control" placeholder="秒に変換して入力してください。">
				</th>
			</tr>
			<tr>
				<th height="75px">3番目の質問の開始時間（s）</th>
				<th class="right-block">
					<input type="number" name="start_time_3" class="form-control" placeholder="秒に変換して入力してください。">
				</th>
			</tr>
		</table>
		<div class="next-button">
			<input class="btn btn-primary" type="submit" value="送信" />
		</div>
	</form>
</div>
@endsection
