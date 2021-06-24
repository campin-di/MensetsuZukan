@section('title', 'プラン選択')
<link href="{{ asset('/css/st/auth/main/register4.css') }}" rel="stylesheet">
@extends('layouts.hr.reverse')
@section('content')
@include('components.parts.page_title_reverse', ['title'=>'STEP4'])

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

      <form method="POST" action="{{ route('hr.register.main.post') }}">
      @csrf
        <div class="card">
          <div class="title"><span class="description-title">面接官プラン</span>とは？</div>
          <p class="description-content-1">
            全国の学生の面接を無料でご覧いただけます。<br>
            ただし、面接採点機能（無料）を<br>
            ご利用いただく必要があります。
          </p>
          <p class="description-content-2">
            ※3ヶ月以上面接採点機能のご利用がない場合、<br>
            自動的に面接動画が視聴不可となります。
          </p>
        </div>

        <input type="hidden" id="plan" class="button" name="plan" value="面接官プラン" required>
        @include('components.parts.button.form.next_button')
      </form>
  @endempty
</div>

<script type="text/javascript" src="{{ asset('/js/auth/hr/main/register4.js') }}"></script>
@endsection
