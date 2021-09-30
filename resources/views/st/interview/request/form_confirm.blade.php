@section('title', '申し込み内容の確認')
<link rel="stylesheet" href="{{ asset('css/st/interview/request/form_confirm.css') }}">
@extends('layouts.st.common')
@section('content')

@include('components.parts.page_title', ['title'=>'確認画面'])

<div class="container confirm-wrapper">
	<form method="post" action="{{ route('interview.request.send') }}">
		@csrf
		<div class="content">
			<div class="content-title">
				<h2>申し込み後の流れ</h2>
			</div>
			<ul class="flow">
				<li>&#9312; 人事がリクエストを承諾するのをお待ちください。</li>
				<li>&#9313; 承諾された場合、「メッセージ」より人事と日程の調整を行ってください。</li>
				<li>&#9314; 日程調整後、マイページ「面接予定」に面接詳細が表示されます。</li>
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
				<li>（マイページから非公開にできます。）</li>
			</ul>
			</div>
		</div>


		<div class="agree">
			<label for="c_agree">
				<input id="c_agree" type="checkbox" name="agree" value="1" required> 注意事項を確認した。
			</label>
		</div>
    	@include('components.parts.button.form.transition_button', ['text' => '申し込む'])
	</form>
</div>
<script type="text/javascript" src="{{ asset('/js/st/interview/schedule/alert_double_click.js') }}"></script>
@endsection
