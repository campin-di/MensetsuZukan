@section('title', 'プロフィールの詳細')
<link rel="stylesheet" href="{{ asset('css/st/mypage/detail.css') }}">
@extends('layouts.st.common')
@section('content')

@include('components.parts.page_title', ['title'=>'詳細プロフィール'])

<div class="container">
  <div class="container_detail">
    <div class="item">
      <input id="acd-check1" class="acd-check" type="checkbox">
      <label class="acd-label" for="acd-check1">企業の基本情報</label>
      <div class="acd-content">
        <div class="company_info">
          <table>
            <tr>
              <th>社名</th>
              <td>{{ $userData->company }}</td>
            </tr>
            <tr>
              <th>企業区分</th>
              <td>{{ $userData->company_type }}</td>
            </tr>
            <tr>
              <th>業界</th>
              <td>{{ $userData->industry }}</td>
            </tr>
            <tr>
              <th>本社所在地</th>
              <td>{{ $userData->location }}</td>
            </tr>
            <tr>
              <th>上場区分</th>
              <td>{{ $userData->stock_type }}</td>
            </tr>
            <tr>
              <th>主な勤務地</th>
              <td>{{ $userData->workplace }}</td>
            </tr>
            <tr>
              <th>事業内容</th>
              <td>{{ $userData->summary }}</td>
            </tr>
            <tr>
              <th>企業ページ</th>
              <td><a href="{{ $userData->site }}">{{ $userData->site }}</a></td>
            </tr>
            <tr>
              <th>採用ページ</th>
              <td><a href="{{ $userData->recruitment }}">{{ $userData->recruitment }}</a></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <div class="item">
      <input id="acd-check2" class="acd-check" type="checkbox">
      <label class="acd-label" for="acd-check2">自己紹介</label>
      <div class="acd-content">
        <p>{{ $userData->introduction }}</p>
      </div>
    </div>
    <div class="item">
      <input id="acd-check3" class="acd-check" type="checkbox">
      <label class="acd-label" for="acd-check3">学生に対するPR</label>
      <div class="acd-content">
        <p>{{ $userData->pr }}</p>
      </div>
    </div>
    <div class="item">
      <input id="acd-check4" class="acd-check" type="checkbox">
      <label class="acd-label" for="acd-check4">普段担当している面接フェーズ</label>
      <div class="acd-content">
        <p>{{ $userData->selection_phase }}</p>
      </div>
    </div>
  </div>
</div>
@endsection
