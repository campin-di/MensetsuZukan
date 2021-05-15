@extends('layouts.hr.reverse')
<link href="{{ asset('/css/st/auth/main/register_comfirm.css') }}" rel="stylesheet">
@section('content')
<div class="top-content-wrapper">
  <div class="top-content">
    <h1>確認画面</h1>
  </div>
</div>

<div class="container form-wrapper">
  <form method="post" action="{{ route('hr.register.main.registered') }}">
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

    <div class="button-wrapper">
      <button type="submit">
      送信
      </button>
    </div>

  </form>
</div>
<script src="https://code.jquery.com/jquery-2.1.0.min.js" ></script>

@endsection
