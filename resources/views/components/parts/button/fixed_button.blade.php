<link href="{{ asset('css/components/parts/button/com_fixed_button.css') }}" rel="stylesheet" type="text/css">
<div class="fixed-button">
  <span>{{ $msg }}</span>
  <a href="{{ route($routeName, $var) }}">{{ $text }}</a>
</div>
