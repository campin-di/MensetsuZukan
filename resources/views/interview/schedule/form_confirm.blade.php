@extends('layouts.common')
@section('content')
<h3>確認</h3>
<form method="post" action="{{ route('interview.schedule.send') }}">
	@csrf
	<div>
		{{ $input['date'] }}
	</div>
	<div>
		{{ $input['time'] }}<br>
	</div>

	<input name="back" type="submit" value="戻る" />
	<input type="submit" value="送信" />

</form>
@endsection
