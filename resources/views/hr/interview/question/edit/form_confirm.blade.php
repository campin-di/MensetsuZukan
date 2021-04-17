@extends('layouts.common_hr')
@section('content')
<h3>確認</h3>
<form method="post" action="{{ route('hr.interview.question.edit.send') }}">
	@csrf
	@for($index = 1; $index <= 6; $index++)
		<div>
			質問{{$index}}：{{$input['question-'.$index]}}
		</div>
	@endfor

	<input name="back" type="submit" value="戻る" />
	<input type="submit" value="送信" />

</form>
@endsection
