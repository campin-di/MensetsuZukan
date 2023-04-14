@section('title', 'スケジュールの調整')
<link rel="stylesheet" href="{{ asset('css/st/interview/schedule/form.css') }}">
@extends('layouts.st.common')
@section('content')

@include('components.parts.page_title', ['title'=>'面接スケジュールを決める'])

<div class="container">
  @include('components.parts.profile', ['imagePath' => $hrUser->image_path, 'userName' => '', 'nickName' => $hrUser->nickname, 'description' => $hrUser->industry, 'introduction' => $hrUser->introduction ])

  <div class="schedule-wrapper">
    <form method="post" class="form" action="{{ route('interview.schedule.post') }}">
      @csrf

      <div class="schedule-description">
        面接候補日を選択してください。
      </div>

      <div class="date-wrapper">
        <lavel>
          <input type="date" name="date" id="date" class="form-control" required>
        </label>
      </div>

      @foreach($timeArray ?? '' as $val => $time)
        <div class="inputGroup">
          <input id="option{{ $loop->iteration }}" name="time[]" type="checkbox" value="{{ $val }}" class="check" required>
          <label for="option{{ $loop->iteration }}">{{ $time }}</label>
        </div>
      @endforeach

      <input type="hidden" name="hr_id" value="{{$hrUser->id}}">
      @include('components.parts.button.form.next_button')
    </form>
  </div>
</div>
<script type="text/javascript" src="{{ asset('/js/st/interview/schedule/form.js') }}"></script>
@endsection
