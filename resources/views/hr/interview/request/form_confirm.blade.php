@section('title', '面接可能日を追加しました')
<link rel="stylesheet" href="{{ asset('css/st/interview/request/form_confirm.css') }}">
@extends('layouts.hr.common')
@section('content')
@include('components.parts.page_title', ['title'=>'確認'])
<div class="container confirm-wrapper">
	<form method="post" action="{{ route('hr.interview.request.send') }}">
		@csrf
		@if(!$reactionFlag)
			<div class="content">
				<div class="content-title">
					<h2>見送り後の流れ</h2>
				</div>
				<ul class="flow">
					<li>&#9312; 見送った理由を記載ください。</li>
					<li>→ 見送り理由は申し込んだ学生に表示されます。</li>
					<li>&#9313; 送信後、別の学生から申し込みがあるのをお待ちください。</li>
				</ul>
			</div>
			<div class="content">
				<div class="content-title">
					<h2>見送り理由</h2>
				</div>
				<div class="content-textarea">
					<textarea name="reject-reason" placeholder="申し込みを見送る理由を入力してください。" required></textarea>
				</div>
			</div>
			@include('components.parts.button.form.transition_button', ['text' => '送信'])
		@else
			<div class="content">
				<div class="content-title">
					<h2>承諾後の流れ</h2>
				</div>
				<ul class="flow">
					<li>&#9312; 「メッセージ」より日程の調整を行ってください。</li>
					<li>&#9313; 日程調整後、トーク画面「面接予約」ボタンから面接予約を行ってください。</li>
					<li>&#9314; 面接予約後、マイページ「面接予定」に面接詳細が表示されます。</li>
					<li>&#9315; 模擬面接当日は、マイページ「面接予定」より面接を行ってください。</li>
				</ul>
			</div>

			<div class="content">
				<div class="content-title">
					<h2>注意事項</h2>
				</div>
				<div>
					<ul class="attention">
						<li>模擬面接の様子は録画・編集されサービス内にアップロードされます。</li>
						<li>その際、モザイク加工によって個人が特定できないように加工されるのでご安心ください。</li>
					</ul>
				</div>
			</div>

			<div class="agree">
				<label for="c_agree">
					<input id="c_agree" type="checkbox" name="agree" value="1" required> 注意事項を確認した。
				</label>
			</div>
			@include('components.parts.button.form.transition_button', ['text' => '送信する'])
		@endif
	</form>
</div>
<script type="text/javascript" src="{{ asset('/js/st/interview/schedule/alert_double_click.js') }}"></script>
@endsection
