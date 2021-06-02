@extends('layouts.st.reverse')
<link href="{{ asset('/css/st/auth/main/register_comfirm.css') }}" rel="stylesheet">
@section('content')
@include('components.parts.page_title_reverse', ['title'=>'入力内容の確認'])

<div class="container form-wrapper">
  <form method="post" action="{{ route('register.main.registered') }}">
    @csrf
    @foreach($confirmArray as $key => $content)
      <div class="form-input-wrapper">
        <label for="email" class="form-title">{{ $key }}</label>
        <div class="form-input">
          <span class="form-control">{{ $content }}</span>
        </div>
      </div>
    @endforeach
    <!--
    <input name="back" type="submit" value="戻る" />
    -->
    @include('components.parts.button.form.transition_button', ['text'=>'送信'])

  </form>
</div>
<script src="https://code.jquery.com/jquery-2.1.0.min.js" ></script>

@endsection
