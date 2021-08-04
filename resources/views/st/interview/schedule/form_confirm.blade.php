@section('title', '予約情報の確認')
<link rel="stylesheet" href="{{ asset('css/st/interview/schedule/form_confirm.css') }}">
@extends('layouts.st.common')
@section('content')

@include('components.parts.page_title', ['title'=>'確認'])

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
				<li>面接日程の変更・キャンセルは、面接日の2日前の午前10時以降は受け付けておりません。</li>
				<li>面接は録画されサービス内にアップロードされます。</li>
				<li>（個人が特定できないように加工されます。）</li>
			</ul>
		</div>

		<div class="agree">
			<label for="c_agree">
				<input id="c_agree" type="checkbox" name="agree" value="1" required> 注意事項を確認した。
			</label>
		</div>
    	@include('components.parts.button.form.transition_button', ['text' => '予約を完了する'])
	</form>
</div>
<script type="text/javascript" src="{{ asset('/js/st/interview/schedule/alert_double_click.js') }}"></script>
@endsection
