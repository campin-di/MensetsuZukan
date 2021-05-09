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
				<th height="75px">URL</th>
				<th class="right-block">
					<input type="text" name="url" class="form-control" placeholder="URLを入力してください。">
				</th>
			</tr>
			<tr>
				<th height="75px">質問</th>
				<th class="right-block">
					<input type="number" name="question_id" class="form-control" placeholder="タイトルを入力してください。">
				</th>
			</tr>
			<tr>
				<th height="75px">点数</th>
				<th class="right-block">
					<input type="number" name="score" min="0" max="100" class="form-control" placeholder="点数を入力してください。">
				</th>
			</tr>
			<tr>
				<th height="75px">レビュー</th>
				<th class="right-block">
					<input type="text" name="review" class="form-control" placeholder="レビューを入力してください。">
				</th>
			</tr>
			<tr>
				<th height="75px">学生のユーザー名</th>
				<th class="right-block">
					<input type="text" name="st_username" class="form-control" placeholder="学生のユーザ名を入力してください。">
				</th>
			</tr>
			<tr>
				<th height="75px">人事のユーザ名</th>
				<th class="right-block">
					<input type="text" name="hr_username" class="form-control" placeholder="人事のユーザ名を入力してください。">
				</th>
			</tr>
		</table>
		<div class="next-button">
			<input class="btn btn-primary" type="submit" value="送信" />
		</div>
	</form>
</div>
@endsection
