@section('title', '企業ページ')
<link rel="stylesheet" href="{{ asset('css/hr/mypage/mypage_offer.css') }}">
@extends('layouts.st.nofooter')
@section('content')

<div class="container">
  <div class="wrapper">
    <div class="company-info-wrapper">
      <div class="company-info">
        <div class="company-info-icon">
          <img class="item_img" src="{{ asset($userData->image_path) }}" alt="アイコン">
        </div>
        <div class="company-info-name">
          {{ $userData->company }}
        </div>
      </div>

    </div>

    @include('components.title.mypage_section',['section_name' => '企業情報'])

    <table class="m-table">
      <tbody>
        <tr>
          <th>会社名</th>
          <td class="company-table-data" colspan="3">{{ $userData->company }}</td>
        </tr>
        <tr>
          <th>業種・業界</th>
          <td class="company-table-data" colspan="3">{{ $userData->industry }}</td>
        </tr>
        <tr>
          <th>企業タイプ</th>
          <td class="company-table-data" colspan="3">{{ $userData->company_type }}</td>
        </tr>
        <tr>
          <th>上場区分</th>
          <td class="company-table-data" colspan="3">{{ $userData->stock_type }}</td>
        </tr>
        <tr>
          <th>本社所在地</th>
          <td class="company-table-data" colspan="3">{{ $userData->location }}</td>
        </tr>
        <tr>
          <th>主な勤務地</th>
          <td class="company-table-data" colspan="3">{{ $userData->workplace }}</td>
        </tr>
        <tr>
          <th>企業HP</th>
          <td class="company-table-data" colspan="3"><a href="{{ $userData->site }}">{{ $userData->site }}</a></td>
        </tr>
        <tr>
          <th>採用ページ</th>
          <td class="company-table-data" colspan="3"><a href="{{ $userData->recruitment }}">{{ $userData->site }}</a></td>
        </tr>
      </tbody>
    </table>

    @include('components.title.mypage_section',['section_name' => '事業内容'])

    <div class="business-content">
      {{ $userData->summary }}
    </div>

    @include('components.title.mypage_section',['section_name' => '運営の調査結果'])

    <div class="company-report">
      <img src="{{ asset($userData->introduction) }}" alt="運営レポート">
    </div>
  </div>
</div>
@endsection
