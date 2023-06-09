@section('title', 'パスワードの再設定')
@extends('layouts.st.common')
@section('content')
@include('components.parts.page_title', ['title'=>'パスワードを忘れた方（学生）'])
<div class="container" style="margin: 100px auto; min-height:50vh;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">登録アカウントを探す</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">メールアドレス</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    パスワード再設定用リンクの送信
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div style="text-align: center;">
                <a href="{{ route('hr.password.request') }}">採用担当者の方はこちら</a>
            </div>
        </div>
    </div>
</div>
@endsection
