@section('title', 'プラン選択')
<link href="{{ asset('/css/st/auth/main/register4.css') }}" rel="stylesheet">
@extends('layouts.hr.reverse')
@section('content')
@include('components.parts.page_title_reverse', ['title'=>'STEP1'])

<div class="container form-wrapper">
    @isset($message)
      <div class="card-body">
        {{$message}}
      </div>
    @endisset

    @empty($message)
      <div class="select-button">
        <button id="hr">面接官プラン</button>
        <button id="offer">オファープラン</button>
      </div>

      <form method="POST" action="{{ route('hr.register2') }}">
      @csrf
        <div class="card">
          <div class="title"><span class="description-title">面接官プラン</span>とは？</div>
          <p class="description-content-1">
          面接官ユーザーとして面接図鑑に参画していただくプランです。<br>
          全国の学生の面接を無料でご覧いただけます。<br>
          </p>
          <p class="description-content-2">
            ※月額課金などは一切ございません
          </p>
        </div>
        <input type="hidden" name="email_verify_token" value="{{ $email_token }}" required>
        <input type="hidden" id="plan" class="button" name="plan" value="面接官プラン" required>
        @include('components.parts.button.form.next_button')
      </form>
  @endempty
</div>

<script type="text/javascript" src="{{ asset('/js/auth/hr/main/register.js') }}"></script>
@endsection
