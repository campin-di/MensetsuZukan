<h3>確認</h3>
<form method="post" action="{{ route('mypage.basic.send') }}">
	@csrf
	<div>
		@foreach($input as $item)
			{{ $item }}<br>
		@endforeach
	</div>


	<input name="back" type="submit" value="戻る" />
	<input type="submit" value="送信" />

</form>
