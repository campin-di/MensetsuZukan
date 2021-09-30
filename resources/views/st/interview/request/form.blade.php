@section('title', '模擬面接申し込み｜'. $hrUser->nickname)

<link rel="stylesheet" href="{{ asset('css/st/interview/request/form.css') }}">
@extends('layouts.st.common')
@section('content')

@include('components.parts.page_title', ['title'=>'模擬面接を申し込む'])

<div class="container">
  @include('components.parts.profile', ['imagePath' => $hrUser->image_path, 'userName' => '', 'nickName' => $hrUser->nickname, 'description' => '', 'introduction' => $hrUser->introduction ])

  <div class="schedule-wrapper">
    <form method="post" class="form" action="{{ route('interview.request.post') }}">
      @csrf

      <h2>都合の付きやすい日程</h2>
      <p></p>

      <h2>候補日程の入力</h2>
      <p>面接を行いたい日程候補を下記の形式で記入してください。</p>

      <textarea name="date" class="date" rows="4" required placeholder='・11月25日(水)：16〜20時&#13;&#10;・11月28日(水)：15~20時&#13;&#10;・11月30日(水)：11~22時'>
      ・○月○日(曜日)：○〜○時
      ・○月○日(曜日)：○〜○時
      ・○月○日(曜日)：○〜○時
      </textarea>

      <input type="hidden" name="hr_id" value="{{$hrUser->id}}">
      @include('components.parts.button.form.next_button')
    </form>
  </div>
</div>
<script type="text/javascript" src="{{ asset('/js/st/interview/schedule/form.js') }}"></script>
@endsection
