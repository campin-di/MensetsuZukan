@section('title', 'スケジュールの調整')
<link rel="stylesheet" href="{{ asset('css/st/interview/schedule/form.css') }}">
@extends('layouts.st.common')
@section('content')

@include('components.parts.page_title', ['title'=>'面接スケジュールを決める'])

<div class="container">
  @include('components.parts.profile', ['imagePath' => $hrUser->image_path, 'userName' => '', 'nickName' => $hrUser->nickname, 'description' => $hrUser->industry, 'introduction' => $hrUser->introduction ])

  <div class="schedule-wrapper">
    @if($is_schedule)
      <form method="post" action="{{ route('interview.schedule.post') }}">
        @csrf

        <div class="schedule-description">
          面接日程を下記から選択してください。
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
              <input type="hidden" name="hr_id" value="{{ $hrUser->id }}">
            </div>
          </div>
        @endforeach

        @include('components.parts.button.form.next_button')
      </form>
    @else
      <div class="container form-wrapper">
        <div class="title">面接が可能な日程はありません。</div>

        @include('components.parts.button.form.complete_button', ['upperRoute' => '/', 'upperText'=>'トップページに戻る', 'underRoute' => 'mypage', 'underText' => 'マイページに戻る', 'var' => ''])
      </div>
    @endif
  </div>
</div>

<script type="text/javascript">
  @if($is_schedule)
    let schedules = @json($schedules);
  @endif
</script>
<script type="text/javascript" src="{{ asset('/js/st/interview/schedule/form.js') }}"></script>
@endsection
