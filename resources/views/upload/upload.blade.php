@extends('layouts.common')
@section('content')
  <!--研究室登録フォーム-->
  <form action="{{ route('uploadRegister') }}" method="POST" class="form-horizontal">
      {{ csrf_field() }}

      <div class="next-button">
        <button type="submit" class="btn btn-primary">登録する</button>
      </div>
   </form>
@endsection
