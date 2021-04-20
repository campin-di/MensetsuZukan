@extends('layouts.common')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">プラン選択</div>

        @isset($message)
          <div class="card-body">
            {{$message}}
          </div>
        @endisset

        @empty($message)
        <div class="card-body">
          <form method="POST" action="{{ route('register.main.post') }}">
          @csrf

          <select name="plan">
            <option value="contributor">投稿者プラン</option>
            <option value="audience">視聴者プラン</option>
          </select>


          <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
              <button type="submit" class="btn btn-primary">
              確認画面へ
              </button>
            </div>
          </div>
          </form>
        </div>
      @endempty
      </div>
    </div>
  </div>
</div>
@endsection
