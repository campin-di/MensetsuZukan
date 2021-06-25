@section('title', 'オファー内容の確認')
<link rel="stylesheet" href="{{ asset('css/hr/interview/offer/form_confirm.css') }}">
@extends('layouts.hr.common')
@section('content')
<div class="top-content-wrapper">
  <div class="top-content">
    <h1>オファー内容の確認</h1>
  </div>
</div>

<div class="container offer-wrapper">
  <div class="st-information-wrapper">
    <div class="st-profile-img">
      <img class="st-photo" src="{{ asset('/img/yoshi.jpg') }}" alt="プロフィール写真">
    </div>
    <div class="st-name">
      {{ $stData->name }}
    </div>
    <div class="st-company">
      {{ $stData->university }}・{{ $stData->faculty }}
    </div>
  </div>


	<form method="post" action="{{ route('hr.offer.send') }}">
		@csrf
		<div class="content-title">
			<h2>オファー内容</h2>
		</div>
		<div class="content-offer">
			{{ $offerContent }}
		</div>
		<div class="content-title">
			<h2>オファー理由</h2>
		</div>
		<div class="content-msg">
			{{ $message }}
		</div>

    @include('components.parts.button.form.transition_button', ['text' => '送信'])
	</form>
</div>
@endsection
