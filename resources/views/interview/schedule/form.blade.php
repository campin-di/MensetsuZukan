@extends('layouts.common')
@section('content')

<div class="container">
  <h1>面接を予約する。</h1>
  <div>
    {{ $hrUser->name }} {{ '@'.$hrUser->username }}
  </div>

  @if($is_schedule)
    <form method="post" action="{{ route('interview.schedule.post') }}">
      @csrf

      <div>
        <label>面接可能日程</label>
      </div>
      @foreach($schedules as $schedule)
        <input type="radio" name="date" value="{{ $schedule->date }}"> {{ $schedule->date }}

        @foreach($timeArray as $key => $time)
          @if($schedule->$key == 1)
            <div>
              <input type="radio" name="time" value="{{ $key }}"> {{ $time }}
              <input type="hidden" name="id" value="{{ $schedule->id }}">
            </div>
          @endif
        @endforeach
      @endforeach

      <div class="next-button">
        <input class="btn btn-primary" type="submit" value="→" />
      </div>
    </form>
  @else
    面接が可能な日程はありません。
  @endif
</div>
@endsection
