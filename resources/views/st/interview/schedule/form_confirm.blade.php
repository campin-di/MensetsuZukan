@extends('layouts.common')
@section('content')
<form method="post" action="{{ route('interview.schedule.send') }}">
	@csrf
	<h1>日時</h1>
	<div>
		{{ $date }}：{{ $time }}
	</div>

	<h1>面接場所</h1>
	<div>
		＜オンライン＞<br>
	　マイページ上に面接のリンクが表示されるので、<br>
	　当日はそのリンクから面接を行ってください。
	</div>

	<h1>注意事項</h1>
	<div>
		※ 面接日程の変更・キャンセルはマイページから行ってください。<br>
		※ 面接日程の変更・キャンセルは、面接日の2営業日前の午前10時以降は受け付けておりません。<br>
		※ 面接は録画されサービス内にアップロードされます。
	</div>

	<input name="back" type="submit" value="戻る" />
	<input type="submit" value="面接予約を完了する" />

</form>
@endsection
