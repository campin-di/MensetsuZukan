<link href="{{ asset('css/components/parts/button/form/com_complete_button.css') }}" rel="stylesheet" type="text/css">
<a class="upper-button" href="{{ url($upperRoute) }}">
  <div>
    {{ $upperText }}
  </div>
</a>
<a class="under-button" href="{{ route($underRoute, $var) }}">
  <div>
    {{ $underText }}
  </div>
</a>
