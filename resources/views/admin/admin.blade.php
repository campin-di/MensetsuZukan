@section('title', '管理画面')
<link href="{{ asset('/css/admin.css') }}" rel="stylesheet">
@extends('layouts.st.common')
@section('content')
<div class="container table-responsive">
		<div class="upload-wrapper flex">
			<div class="upload">
				<a href="{{route('upload')}}">新しく動画をアップロードする</a>
			</div>
			<div class="upload">
				<a href="{{route('trim')}}">コマンドを作成する</a>
			</div>
		</div>

		<h2>学生用動画</h2>
		<table class="table table-hover table-sm">
			<thead>
				<tr class="table-primary">
					<th scope="col">ID</th>
					<th scope="col">対象</th>
					<th scope="col">動画タイトル</th>
					<th scope="col">サムネイル</th>
					<th scope="col">点数</th>
					<th scope="col">学生名</th>
					<th scope="col">人事名</th>
					<th scope="col">動画URL</th>
					<th scope="col">動画ID</th>
					<th scope="col">ニックネーム</th>
					<th scope="col">会社名</th>
					<th scope="col">レビュー</th>
					<th scope="col">アップロード日</th>
					
				</tr>
			</thead>
		  <tbody>
				@foreach($stVideoCollection as $video)
					<tr>
						<th scope="row">{{ $video['id'] }}</th>
						<td>{{ $video['type'] }}</td>
						<td>{{ $video['title'] }}</td>
						@if($video['thumbnail_name'] == 'none')
							<td><a href="{{ route('thumbnail', $video['id']) }}">アップロード</a></td>
						@else
							<td><a href="{{ route('thumbnail', $video['id']) }}">{{ $video['thumbnail_name'] }}</a></td>
						@endif
						<td>{{ $video['score'] }}</td>
						<td>{{ $video['stName'] }}</td>
						<td>{{ $video['hrName'] }}</td>
						<td><a href="{{ $video['vimeoUrl'] }}" target="_blank" rel="noopener noreferrer">アクセス</a></td>
						<td>{{ $video['vimeoId'] }}</td>
						<td>{{ $video['stNickname'] }}</td>
						<td>{{ $video['company'] }}</td>
						<td>{{ $video['review'] }}</td>
						<td>{{ $video['upload'] }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<h2>人事用動画</h2>

		<table class="table table-hover table-sm">
			<thead>
				<tr class="table-primary">
					<th scope="col">ID</th>
					<th scope="col">対象</th>
					<th scope="col">動画タイトル</th>
					<th scope="col">サムネイル</th>
					<th scope="col">点数</th>
					<th scope="col">学生名</th>
					<th scope="col">人事名</th>
					<th scope="col">動画URL</th>
					<th scope="col">動画ID</th>
					<th scope="col">ニックネーム</th>
					<th scope="col">会社名</th>
					<th scope="col">レビュー</th>
					<th scope="col">アップロード日</th>
					
				</tr>
			</thead>
		  <tbody>
				@foreach($hrVideoCollection as $video)
					<tr>
						<th scope="row">{{ $video['id'] }}</th>
						<td>{{ $video['type'] }}</td>
						<td>{{ $video['title'] }}</td>
						@if($video['thumbnail_name'] == 'none')
							<td><a href="{{ route('thumbnail', $video['id']) }}">アップロード</a></td>
						@else
							<td><a href="{{ route('thumbnail', $video['id']) }}">{{ $video['thumbnail_name'] }}</a></td>
						@endif
						<td>{{ $video['score'] }}</td>
						<td>{{ $video['stName'] }}</td>
						<td>{{ $video['hrName'] }}</td>
						<td><a href="{{ $video['vimeoUrl'] }}" target="_blank" rel="noopener noreferrer">アクセス</a></td>
						<td>{{ $video['vimeoId'] }}</td>
						<td>{{ $video['stNickname'] }}</td>
						<td>{{ $video['company'] }}</td>
						<td>{{ $video['review'] }}</td>
						<td>{{ $video['upload'] }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
</div>
@endsection
