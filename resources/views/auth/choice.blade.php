@extends('layouts.st.common')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
          <button id="st">学生</button>
          <button id="hr">人事</button>
          <div>
            <div class="description">学生</div>
            <span class="description">学生</span>として利用いただけます。<br>
            ※登録後の変更は出来かねますので、ご注意ください。
          </div>
          <a id="url_st" class="nav-link" href="{{ route('register') }}">→</a>
          <a id="url_hr" class="nav-link" href="{{ route('hr.register') }}">→</a>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="{{ asset('/js/auth/choice.js') }}"></script>
@endsection
