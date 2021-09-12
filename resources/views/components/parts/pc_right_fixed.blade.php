<link href="{{ asset('css/components/parts/com_pc_right_fixed.css') }}" rel="stylesheet" type="text/css">
<a href="{{ route($route) }}" class="interview-wrapper fuwafuwa"> 
  <div class="interview-img">
    <img src="{{ asset($img) }}" alt="面接官を探しているイラスト">
  </div>
  <div class="interview-description">
    {{ $description }}
  </div>
  @if(isset($flag) && $flag > 0)
    <div class="circle-wrapper">
      <div class="circle">{{$flag}}</div>
    </div>
  @endif
</a>
