@section('title', '面接可能日の追加')
<link rel="stylesheet" href="{{ asset('css/hr/interview/schedule/add.css') }}">
@extends('layouts.hr.nofooter')
@section('content')

@include('components.parts.page_title', ['title'=>'面接可能な日程の追加'])

<div class="container">
  <form method="post" class="form" action="{{ route('hr.interview.schedule.post') }}">
    @csrf

    <div class="date-wrapper">
      <lavel>
        <input type="date" name="date" id="date" class="form-control" required>
      </label>
    </div>

    @foreach($timeArray as $val => $time)
      <div class="inputGroup">
        <input id="option{{ $loop->iteration }}" name="time[]" type="checkbox" value="{{ $val }}" class="check" required>
        <label for="option{{ $loop->iteration }}">{{ $time }}</label>
      </div>
    @endforeach

    @include('components.parts.button.form.next_button')
  </form>

  <div id="delete-date">
    @include('components.parts.button.fixed_button',['routeName' => 'hr.interview.schedule.check', 'var'=>'', 'msg' => '', 'text' => '面接可能日を確認・変更する'])
  </div>

</div>
<script type="text/javascript" src="{{ asset('/js/hr/interview/schedule/add.js') }}"></script>
@endsection
