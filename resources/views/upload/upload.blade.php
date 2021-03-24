@extends('layouts.common')
@section('content')
<div class="container">
  <!--研究室登録フォーム-->
  <form action="{{ route('uploadRegister') }}" method="POST" class="form-horizontal">
      {{ csrf_field() }}
      <table>
        <tr>
          <th height="75px">リンク</th>
          <th class="right-block">
            <input type="text" name="youtube_link" class="form-control" placeholder="リンクを入力してください。">
          </th>
        </tr>
        <tr>
          <th height="75px">タイトル</th>
          <th class="right-block">
            <input type="text" name="title" class="form-control" placeholder="タイトルを入力してください。">
          </th>
        </tr>
        <tr>
          <th height="75px">点数</th>
          <th class="right-block">
            <input type="number" name="score" min="0" max="100" class="form-control" placeholder="点数を入力してください。">
          </th>
        </tr>
        <tr>
          <th height="75px">レビュー</th>
          <th class="right-block">
            <input type="text" name="review" class="form-control" placeholder="レビューを入力してください。">
          </th>
        </tr>
        <tr>
          <th height="75px">学生のユーザー名</th>
          <th class="right-block">
            <input type="text" name="st_username" class="form-control" placeholder="学生のユーザ名を入力してください。">
          </th>
        </tr>
        <tr>
          <th height="75px">人事のユーザー名</th>
          <th class="right-block">
            <input type="text" name="hr_username" class="form-control" placeholder="人事のユーザ名を入力してください。">
          </th>
        </tr>
      </table>

      <div class="next-button">
        <button type="submit" class="btn btn-primary">登録する</button>
      </div>
   </form>
</div>
@endsection
