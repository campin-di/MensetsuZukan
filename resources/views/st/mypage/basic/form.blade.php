@extends('layouts.st.common')
<link rel="stylesheet" href="{{ asset('css/st/mypage/basic/form.css') }}">
@section('content')

@include('components.parts.page_title', ['title'=>'基本情報の変更'])

<div class="container">
	@if ($errors->any())
	<div style="color:red;">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
	</div>
	@endif

	<div class="container_profile">
		<div class="container_profile_img_wrapper">
			<img id="profile_img" class="container_profile_img" src="{{ asset('img/kokyo.png') }}" alt="プロフィール画像">
			<a href="{{ route('mypage.basic.upload', $userData->id) }}" class="mask">
				<div class="caption">編集</div>
			</a>
		</div>
		<p class="container_profile_name">
	    {{ $userData->name }}
	    {{ $userData->nickname }}
	  </p>
	</div>

	<!--研究室登録フォーム-->
	<form method="post" action="{{ route('mypage.basic.post') }}">
		@csrf

		<table>
			<tr>
				<th height="75px">ユーザーネーム</th>
				<th class="right-block">
					<input type="text" name="username" class="form-control" placeholder="ユーザーネーム">
				</th>
			</tr>
			<tr>
				<th height="75px">パスワード</th>
				<th class="right-block">
					<input type="text" name="password" class="form-control" placeholder="パスワード">
				</th>
			</tr>
		</table>
		<div class="next-button">
			<input class="btn btn-primary" type="submit" value="送信" />
		</div>
	</form>
</div>
@endsection
