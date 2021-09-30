@section('title', '面接可能日の追加')
<link rel="stylesheet" href="{{ asset('css/hr/interview/schedule/add.css') }}">
@extends('layouts.hr.nofooter')
@section('content')

@include('components.parts.page_title', ['title'=>'申し込みの承諾 or 見送り'])

<div class="container">
  <form method="post" class="form" action="{{ route('hr.interview.request.post') }}">
    @csrf
    <div class="schedule-wrapper">
      <div class="schedule-description">
        下記から選択してください。<br>
      </div>

      <div class="form-input-wrapper">
        <div class="form-input">
          <select id="none" name="reaction" class="form-control" required>
            <option value="">選択してください。</option>
            <option value="consent">承諾する</option>
            <option value="reject">見送る</option>
          </select>
          <input type="hidden" name="st_id" value="{{ $st_id }}">
        </div>
      </div>

      @include('components.parts.button.form.next_button')
  </form>
</div>

<script type="text/javascript" src="{{ asset('/js/hr/interview/schedule/add.js') }}"></script>
@endsection
