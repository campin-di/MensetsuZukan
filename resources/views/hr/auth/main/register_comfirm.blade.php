@extends('layouts.hr.common')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">本会員登録確認</div>

        <form method="post" action="{{ route('hr.register.main.registered') }}">
          @csrf
          @foreach($confirmArray as $key => $content)
            <div>
              {{ $key }}：{{ $content }}
            </div>
          @endforeach
          <input name="back" type="submit" value="戻る" />
          <input type="submit" value="送信" />

        </form>
      </div>
    </div>
  </div>
</div>
@endsection
