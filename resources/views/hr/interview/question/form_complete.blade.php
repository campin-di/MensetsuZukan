@extends('layouts.hr.common')
@section('content')

<h3>質問リストの作成を完了しました。</h3>
<p>
  質問リストは、面接情報の詳細ページから閲覧できるようになっています。<br>
  面接当日までに質問リストを控えておいてください。<br>
  面接後に質問ごとの評価を記入していただきます。
</p>
<div>
  <a href="{{ route('hr.mypage') }}">マイページに戻る</a>
</div>
<div>
  <a href="{{ route('hr.interview.detail', $id) }}">面接情報の詳細ページに戻る</a>
</div>

@endsection
