@extends('layouts.common')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">本会員登録確認</div>

                <form method="post" action="{{ route('hr.register.main.registered') }}">
                	@csrf
                  @foreach($register_input as $item)
                    {{ $item }}
                  @endforeach

                  @foreach($register2_input as $item)
                    {{ $item }}
                  @endforeach

                	<input name="back" type="submit" value="戻る" />
                	<input type="submit" value="送信" />

                </form>

{{--
                <div class="card-body">
                    <form method="POST" action="{{ route('register.main.registered', ['token' => $email_token]) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">名前</label>
                            <div class="col-md-6">
                                <span class="">{{$user->name}}</span>
                                <input type="hidden" name="name" value="{{$user->name}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">フリガナ</label>
                            <div class="col-md-6">
                                <span class="">{{$user->username}}</span>
                                <input type="hidden" name="username" value="{{$user->username}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="graduate" class="col-md-4 col-form-label text-md-right">生年月日</label>
                            <div class="col-md-6">
                                <span class="">{{$user->graduate_year}}年</span>
                                <input type="hidden" name="graduate_year" value="{{$user->graduate_year}}">
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    本登録
                                </button>
                            </div>
                        </div>
                    </form>
--}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
