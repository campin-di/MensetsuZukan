@section('title', '面接日程を決める')
<link rel="stylesheet" href="{{ asset('css/st/interview/schedule/form.css') }}">
@extends('layouts.hr.nofooter')
@section('content')

@include('components.parts.page_title', ['title'=>'面接日程の選択'])

<div class="container">
  <form method="post" class="form" action="{{ route('hr.interview.schedule.post') }}">
    @csrf

    <div class="schedule-description">
      面接日を選択してください。
    </div>

    <div class="date-wrapper">
      <lavel>
        <input type="date" name="date" id="date" class="form-control" required>
      </label>
    </div>

    @foreach($timeArray ?? '' as $val => $time)
      <div class="inputGroup">
        <input id="option{{ $loop->iteration }}" name="time" type="radio" value="{{ $val }}" class="check" required>
        <label for="option{{ $loop->iteration }}">{{ $time }}</label>
      </div>
    @endforeach

    <input type="hidden" name="stId" value="{{$st->id}}">
    @include('components.parts.button.form.next_button')
  </form>
</div>
<script type="text/javascript" src="{{ asset('/js/hr/interview/schedule/form.js') }}"></script>
@endsection
