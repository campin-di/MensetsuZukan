@extends('layouts.st.common')
<link rel="stylesheet" href="{{ asset('css/st/interview/schedule/form.css') }}">
@section('content')

<div class="top-content-wrapper">
  <div class="top-content">
    <h1>面接スケジュールを決める。</h1>
  </div>
</div>

<div class="container">
  <div class="hr-information-wrapper">
    <div class="hr-profile-img">
      <img class="hr-photo" src="{{ asset('/img/yoshi.jpg') }}" alt="プロフィール写真">
    </div>
    <div class="hr-name">
      {{ $hrUser->name }}
    </div>
    <div class="hr-company">
      会社名
    </div>
  </div>

  <div class="schedule-wrapper">
    @if($is_schedule)
    <form method="post" action="{{ route('interview.schedule.post') }}">
      @csrf

      <div class="schedule-description">
        面接日程を下記から選択してください。
      </div>

      @foreach($schedules as $schedule)
        <div class="form-input-wrapper">
          <div class="form-input">
            <select id="{{ $schedule->date }}" name="{{ $schedule->date }}" class="form-control" required>
              <option value="">{{ $schedule->date }}</option>
              @foreach($timeArray as $key => $time)
                @if($schedule->$key == 1)
                  <option value="{{ $schedule->date }}:{{ $key }}" @if(old('schedule') == "{{ $key }}{{ $time }}") selected @endif>{{ $schedule->date }}：{{ $time }}</option>
                @endif
              @endforeach
            </select>
            <input type="hidden" name="hr_id" value="{{ $schedule->hr_id }}">
          </div>
        </div>
      @endforeach

      <div class="button-wrapper">
        <button type="submit">
          →
        </button>
      </div>
    </form>
    @else
    面接が可能な日程はありません。
    @endif
  </div>
</div>

<script type="text/javascript">
  let schedules = @json($schedules);
</script>
<script type="text/javascript" src="{{ asset('/js/st/interview/schedule/form.js') }}"></script>
@endsection
