@section('title', '面接可能日の追加')
<link rel="stylesheet" href="{{ asset('css/hr/interview/schedule/add.css') }}">
@extends('layouts.hr.nofooter')
@section('content')

@include('components.parts.page_title', ['title'=>'面接候補日の選択'])

<div class="container">
  <form method="post" class="form" action="{{ route('hr.interview.schedule.post') }}">
    @csrf
    <div class="schedule-wrapper">
      <div class="schedule-description">
        面接日程を下記から選択してください。<br>
      </div>

      @foreach($scheduleCollection as $date => $timeArray)
        <div class="form-input-wrapper">
          <div class="form-input">
            <select id="{{ $date }}" name="{{ $date }}" class="form-control" required>
              <option value="">{{ $date }}</option>
              @foreach($timeArray as $key => $time)
                <option value="{{ $date }}:{{ $key }}" @if(old('date') == "{{ $date }}:{{ $key }}") selected @endif>{{ $date }}：{{ $time }}</option>
              @endforeach
            </select>
            <input type="hidden" name="st_id" value="{{ $st_id }}">
          </div>
        </div>
        @endforeach
        <div class="form-input-wrapper">
          <div class="form-input">
            <select id="none" name="none" class="form-control" required>
              <option value="">希望の候補日がない場合</option>
              <option value="none">候補日の日程が全て埋まっている</option>
            </select>
            <input type="hidden" name="st_id" value="{{ $st_id }}">
          </div>
        </div>

      @include('components.parts.button.form.next_button')
  </form>
</div>
<script type="text/javascript">
  let schedules = @json($schedules);
</script>
<script type="text/javascript" src="{{ asset('/js/hr/interview/schedule/add.js') }}"></script>
@endsection
