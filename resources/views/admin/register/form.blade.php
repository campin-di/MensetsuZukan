@section('title', '動画のアップロード')
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

	<form method="post" action="{{ route('content.register.post') }}">
		@csrf
		<table>
			<tr>
				<th height="75px">面接ID(interview_id)：　</th>
				<th class="right-block">
					<input type="text" name="interview_id" class="form-control" placeholder="IDを入力してください。">
				</th>
			</tr>
		</table>
		<div class="next-button">
			<input class="btn btn-primary" type="submit" value="コンテンツを登録する" />
		</div>
	</form>
</div>

<div class="container table-responsive" style="margin: 50px auto;">
	<table class="table table-hover table-sm">
		<thead>
			<tr class="table-primary">
				<th scope="col">ID</th>
				<th scope="col">学生ID</th>
				<th scope="col">学生名（ニックネーム）</th>
				<th scope="col">人事ID</th>
				<th scope="col">人事名（ニックネーム）</th>
				<th scope="col">date</th>
				<th scope="col">time</th>
			</tr>
		</thead>
		<tbody>
			@foreach($interviewCollection as $interview)
				<tr>
					<th scope="row">{{ $interview['id'] }}</th>
					<td>{{ $interview['stId'] }}</td>
					<td>{{ $interview['stName'] }}  {{ ($interview['stNickname']) }}</td>
					<td>{{ $interview['hrId'] }}</td>
					<td>{{ $interview['hrName'] }} {{ ($interview['hrNickname']) }}</td>
					<td>{{ $interview['date'] }}</td>
					<td>{{ $interview['time'] }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>

@endsection
