@extends('layouts.st.common')
<link rel="stylesheet" href="{{ asset('css/st/interview/schedule/confirm.css') }}">
@section('content')
<div class="top-content-wrapper">
  <div class="top-content">
    <h1>面接スケジュールの確認</h1>
  </div>
</div>

<div class="container confirm-wrapper">
	<form method="post" action="{{ route('interview.schedule.send') }}">
		@csrf
		<div class="content">
			<div class="content-title">
				<h2>日時</h2>
			</div>
			<div class="date">
				{{ $date }}：{{ $time }}
			</div>
		</div>

		<div class="content">
			<div class="content-title">
				<h2>面接場所</h2>
			</div>
			<div>
			＜オンライン＞<br>
			マイページ上に面接のリンクが表示されるので、当日はそのリンクから面接を行ってください。
			</div>
		</div>

		<div class="content">
			<div class="content-title">
				<h2>注意事項</h2>
			</div>
			<ul class="attention">
				<li>面接日程の変更・キャンセルはマイページから行ってください。</li>
				<li>面接日程の変更・キャンセルは、面接日の2営業日前の午前10時以降は受け付けておりません。</li>
				<li>面接は録画されサービス内にアップロードされます。</li>
			</ul>
		</div>

		<div class="agree">
			<label for="c_agree">
				<input id="c_agree" type="checkbox" name="agree" value="1" required> 注意事項を確認した。
			</label>
		</div>
		<div class="button-wrapper">
			<button type="submit">
				予約を完了する
			</button>
		</div>
	</form>
</div>
@endsection
