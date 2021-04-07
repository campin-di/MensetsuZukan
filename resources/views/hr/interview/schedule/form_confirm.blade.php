@extends('layouts.common_hr')
@section('content')
<h3>確認</h3>
<form method="post" action="{{ route('hr.interview.schedule.send') }}">
	@csrf
	<div>
		{{$input['date']}}
	</div>
	<div>
		@foreach($input['time'] as $time)
			{{ $time }}<br>
		@endforeach
	</div>

	<input name="back" type="submit" value="戻る" />
	<input type="submit" value="送信" />

</form>
@endsection
