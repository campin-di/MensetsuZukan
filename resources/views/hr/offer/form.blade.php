@extends('layouts.common_hr')
@section('content')

<div class="container">
  <h1>オファー</h1>
  <div>
    {{ $stName }}
  </div>
  <form method="post" action="{{ route('hr.offer.post') }}">
    @csrf

    <div>
      <label>オファー内容</label>
    </div>
    <div>
      <select name="offer_content">
        <option value="2次面接から（Webテスト無）"> 2次面接から（Webテスト無）</option>
        <option value="2次面接から（Webテスト有）">2次面接から（Webテスト有）</option>
        <option value="インターン招待（選考免除）">インターン招待（選考免除）</option>
        <option value="インターン招待（Webテストのみ）">インターン招待（Webテストのみ）</option>
      </select>
    </div>
    <div>
      <label>学生へのメッセージ</label>
    </div>
    <div>
      <textarea name="message" placeholder="例：" required></textarea>
    </div>

    </table>
    <div class="next-button">
      <input type="hidden" name="stId" value="{{ $stId }}">
      <input class="btn btn-primary" type="submit" value=" → " />
    </div>
  </form>
</div>
<script src="{{ asset('/js/offer.js') }}"></script>
@endsection
