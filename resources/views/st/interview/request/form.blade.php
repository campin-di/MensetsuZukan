@section('title', $hrUser->nickname. 'さんに模擬面接申し込み')

<link rel="stylesheet" href="{{ asset('css/st/interview/request/form.css') }}">
@extends('layouts.st.common')
@section('content')

@include('components.parts.page_title', ['title'=>'面接日程の候補を入力'])

<div class="container">
  <div class="schedule-wrapper">
    <form method="post" class="form" action="{{ route('interview.request.post') }}">
      @csrf

      <p>面接を実施したい日程候補を下記の形式で記入してください。</p>

      <div class="flame27 flame-textarea">
        <span class="flame27-title flame-title-textarea">記入欄 </span>
        <textarea name="date" class="date" rows="3" placeholder='（例）・11月25日(水)：16〜20時&#13;&#10;　　　・11月28日(水)：15~20時&#13;&#10;　　　・11月30日(水)：11~22時' required></textarea>
      </div>

      <div class="flame27">
        <span class="flame27-title">テンプレート <a id="copy" class="copy-button" href="javascript:void(0);" onclick="OnLinkClick();">（ コピーして使う ）</a></span>
        <p id="templete">
        ・○月○日(曜日)：○〜○時<br>
        ・○月○日(曜日)：○〜○時<br>
        ・○月○日(曜日)：○〜○時
        </p>
      </div>

      <input type="hidden" name="hr_id" value="{{$hrUser->id}}">
      @include('components.parts.button.form.next_button')
    </form>
  </div>
</div>
<script type="text/javascript" src="{{ asset('/js/st/interview/request/form.js') }}"></script>
@endsection
