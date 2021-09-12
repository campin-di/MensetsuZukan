<link href="{{ asset('css/components/parts/com_pc_left_fixed.css') }}" rel="stylesheet" type="text/css">
<a href="{{ route($route) }}" class="left-interview-wrapper fuwafuwa"> 
  <div class="left-interview-img">
    <img src="{{ asset($img) }}" alt="面接官を探しているイラスト">
  </div>
  <div class="left-interview-description">
    {{ $description }}
  </div>
</a>
