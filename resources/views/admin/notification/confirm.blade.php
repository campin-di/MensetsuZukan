@section('title', 'アップロード動画の確認')
@extends('layouts.st.common')
@section('content')
	<h3>確認</h3>
	<form method="post" action="{{ route('notification.send') }}">
		@csrf
		<div>
			@foreach($input as $item)
				{{ $item }}<br>
			@endforeach
		</div>

		<input name="back" type="submit" value="戻る" />
		<input type="submit" value="送信" />

	</form>
@endsection
