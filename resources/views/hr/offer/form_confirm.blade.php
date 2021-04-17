@extends('layouts.common_hr')
@section('content')
<h1>オファー内容の確認</h1>
<form method="post" action="{{ route('hr.offer.send') }}">
	@csrf
	<div>
		{{ $input['username'] }}
	</div>
	<div>
		{{ $input['offer_content'] }}
	</div>
	<div>
		{{ $input['message'] }}
	</div>

	<input name="back" type="submit" value="戻る" />
	<input type="submit" value="送信" />

</form>
@endsection
