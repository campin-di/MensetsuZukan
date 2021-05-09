@extends('layouts.st.common')
@section('content')
<form method="post" action="{{ route('interview.cancel', $id) }}">
	@csrf

	<div>
		本当に面接をキャンセルしますか？
	</div>

	<div>
		<a href="{{ route('mypage') }}">マイページに戻る</a>
	</div>
	<input type="submit" value="面接予約を完了する" />

</form>
@endsection
