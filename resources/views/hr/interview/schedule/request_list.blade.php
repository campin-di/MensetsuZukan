@section('title', '面接リクエスト一覧')
<link rel="stylesheet" href="{{ asset('css/st/interview/search.css') }}">
@extends('layouts.hr.common')
@section('content')

@include('components.parts.page_title', ['title'=>'面接リクエスト一覧'])

<div class="container">
  @foreach($stCollection as $st)
  <div class="hr-profile-wrapper">
    <a href="{{ route('hr.interview.schedule.form', $st['id']) }}">
        <div class="flex">
        <div class="left-child">
            <img class="hr-photo" src="{{ asset($st['imagePath']) }}" alt="プロフィール写真">
        </div>
        <div class="right-child">
            {{ $st['nickname'] }}
        </div>
        </div>
        <div class="company-information-wrapper flex">
            <div class="company-industry">
                <img class="icon" src="{{ asset('/img/icon/industry.png') }}" alt="アイコン">
                <span class="company-information">{{ $st['industry'] }}志望</span>
            </div>
            <div class="company-location">
                <img class="icon" src="{{ asset('/img/icon/location.png') }}" alt="アイコン">
                <span>{{ $st['companyType'] }}志望</span>
            </div>
        </div>
        <div class="pr-message">
        {{ $st['introduction'] }} 
        </div>
    </a>
  <a class="hr-mypage" href="{{ route('hr.stpage', $st['id']) }}">{{$st['nickname']}}さんのマイページへ</a>
  </div>
  @endforeach
</div>

<script type="text/javascript" src="{{ asset('/js/st/interview/search.js') }}"></script>
@endsection
