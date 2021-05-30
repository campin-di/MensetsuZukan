@extends('layouts.st.common')
@section('content')
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

	<form method="post" action="{{ route('mypage.basic.upload.post') }}" enctype="multipart/form-data">
		@csrf
		<table>
			<tr>
				<th class="right-block">
					<input type="file" name="image" accept="image/png, image/jpeg" />
				</th>
			</tr>
		</table>
		<input type="hidden" name="id" value="{{ $id }}">
		<div class="next-button">
			<input class="btn btn-primary" type="submit" value="アップロード" />
		</div>
	</form>
</div>
@endsection
