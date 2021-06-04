@extends('layouts.hr.common')
<link rel="stylesheet" href="{{ asset('css/st/home.css') }}">
@section('content')

  <div class="filter-wrapper flex">
    <div class="form-input-wrapper">
      <label for="question" class="form-title">質問</label>
      <div class="form-input">
        <select id="question" class="form-control">
          <option value="指定なし">指定なし</option>
          @foreach($questions as $question)
            <option id="question-{{ $loop->iteration }}" value="{{ $question }}" @if(old('question') == "{{ $question }}") selected @endif>{{ $question }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="form-input-wrapper">
      <label for="score" class="form-title">得点</label>
      <div class="form-input">
        <select id="score" class="form-control">
          <option value="指定なし">全得点</option>
          <option value="60">70点未満</option>
          <option value="70">70点～79点</option>
          <option value="80">80点～89点</option>
          <option value="90">90点～99点</option>
          <option value="100">100点</option>
        </select>
      </div>
    </div>
    <div class="form-input-wrapper">
      <label for="postedDate" class="form-title">投稿日</label>
      <div class="form-input">
        <select id="postedDate" class="form-control">
          <option value="指定なし">指定なし</option>
          <option value="1-w">1週間以内</option>
          <option value="1-m">1ヶ月以内</option>
          <option value="3-m">3ヶ月以内</option>
          <option value="6-m">6ヶ月以内</option>
          <option value="1-y">1年以内</option>
        </select>
      </div>
    </div>
  </div>

  <div class="contents-wrapper">
    @include('components.parts.video_content', ['routeName' => 'hr.watch', 'upperRouteName' => 'hr.stpage', 'underRouteName' => 'hr.hrpage'])
  </div>

  <script type="text/javascript">
    let questions = @json($questions);
  </script>
  <script type="text/javascript" src="{{ asset('/js/home.js') }}"></script>
@endsection
