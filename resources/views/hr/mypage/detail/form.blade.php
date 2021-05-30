@extends('layouts.hr.common')
@section('content')
<div class="container">
	<h3>フォーム</h3>
	@if ($errors->any())
	<div style="color:red;">
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif

	<!--研究室登録フォーム-->
	<form method="post" action="{{ route('hr.mypage.detail.post') }}">
		@csrf

		<table>
			<tr>
				<th height="75px">どんな面接ができる？</th>
				<th class="right-block" width="600px">
					<textarea type="text" name="pr" class="form-control" rows="10">
						{{ $profileDetailArray['pr'] }}
					</textarea>
				</th>
			</tr>
		</table>

		<div class="form-group row">
			<label for="company" class="col-md-4 col-form-label text-md-right">企業名*</label>
			<div class="col-md-6">
				<input id="company" type="text" class="form-control{{ $errors->has('company') ? ' is-invalid' : '' }}" name="company" value="{{ old('company') }}" placeholder="例：株式会社ぱむ" required>

				@if ($errors->has('company'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('company') }}</strong>
					</span>
				@endif
			</div>
		</div>

		<div class="form-group row">
		<label for="industry" class="col-md-4 col-form-label text-md-right">業界区分*</label>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-6">
						<select id="industry" class="form-control" name="industry" required>
							<option value="">業界区分を選択してください。</option>
							<option value="IT" @if(old('industry') == "IT") selected @endif>IT</option>
							<option value="食品" @if(old('industry') == "食品") selected @endif>食品</option>
							<option value="人材" @if(old('industry') == "人材") selected @endif>人材</option>
						</select>
						@if ($errors->has('industry'))
							<span class="help-block">
								<strong>{{ $errors->first('industry') }}</strong>
							</span>
						@endif
					</div>
				</div>
			</div>
		</div>

		<div class="form-group row">
		<label for="location" class="col-md-4 col-form-label text-md-right">本社所在地*</label>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-6">
						<select id="location" class="form-control" name="location" required>
							<option value="">本社所在地を選択してください。</option>
							<option value="北海道" @if(old('location') == "北海道") selected @endif>北海道</option>
							<option value="青森県" @if(old('location') == "青森県") selected @endif>青森県</option>
							<option value="岩手県" @if(old('location') == "岩手県") selected @endif>岩手県</option>
						</select>
						@if ($errors->has('location'))
							<span class="help-block">
								<strong>{{ $errors->first('location') }}</strong>
							</span>
						@endif
					</div>
				</div>
			</div>
		</div>

		<div class="form-group row">
		<label for="company_type" class="col-md-4 col-form-label text-md-right">企業区分*</label>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-6">
						<select id="company_type" class="form-control" name="company_type" required>
							<option value="">属する企業区分を選択してください。</option>
							<option value="東証一部" @if(old('company_type') == "東証一部") selected @endif>東証一部</option>
							<option value="マザーズ" @if(old('company_type') == "マザーズ") selected @endif>マザーズ</option>
							<option value="未上場" @if(old('company_type') == "未上場") selected @endif>未上場</option>
						</select>
						@if ($errors->has('company_type'))
							<span class="help-block">
								<strong>{{ $errors->first('company_type') }}</strong>
							</span>
						@endif
					</div>
				</div>
			</div>
		</div>

		<div class="form-group row">
			<label for="position" class="col-md-4 col-form-label text-md-right">役職</label>
			<div class="col-md-6">
				<input id="position" type="text" class="form-control{{ $errors->has('position') ? ' is-invalid' : '' }}" name="position" value="{{ old('position') }}" required>

				@if ($errors->has('position'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('position') }}</strong>
					</span>
				@endif
			</div>
		</div>

		<div class="form-group row">
		<label for="jobtype" class="col-md-4 col-form-label text-md-right">勤務地</label>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-6">
						<select id="workplace" class="form-control" name="workplace">
							<option value="">勤務地を選択してください。</option>
							<option value="東京都" @if(old('workplace') == "東京都") selected @endif>東京都</option>
							<option value="大阪府" @if(old('workplace') == "大阪府") selected @endif>大阪府</option>
							<option value="福岡県" @if(old('workplace') == "福岡県") selected @endif>福岡県</option>
						</select>
						@if ($errors->has('workplace'))
							<span class="help-block">
								<strong>{{ $errors->first('workplace') }}</strong>
							</span>
						@endif
					</div>
				</div>
			</div>
		</div>

		<div class="form-group row">
			<label for="summary" class="col-md-4 col-form-label text-md-right">事業概要</label>
			<div class="col-md-6">
				<input id="summary" type="text" class="form-control{{ $errors->has('summary') ? ' is-invalid' : '' }}" name="summary" value="{{ old('summary') }}" required>

				@if ($errors->has('summary'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('summary') }}</strong>
					</span>
				@endif
			</div>
		</div>

		<div class="form-group row">
			<label for="recruitment" class="col-md-4 col-form-label text-md-right">募集要項URL</label>
			<div class="col-md-6">
				<input id="recruitment" type="text" class="form-control{{ $errors->has('recruitment') ? ' is-invalid' : '' }}" name="recruitment" value="{{ old('recruitment') }}" required>

				@if ($errors->has('recruitment'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('recruitment') }}</strong>
				</span>
				@endif
			</div>
		</div>

		<div class="form-group row">
			<label for="site" class="col-md-4 col-form-label text-md-right">募集要項URL</label>
			<div class="col-md-6">
				<input id="site" type="text" class="form-control{{ $errors->has('site') ? ' is-invalid' : '' }}" name="site" value="{{ old('site') }}" required>

				@if ($errors->has('site'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('site') }}</strong>
					</span>
				@endif
			</div>
		</div>


		<div class="next-button">
			<input class="btn btn-primary" type="submit" value="送信" />
		</div>
	</form>
</div>
@endsection
