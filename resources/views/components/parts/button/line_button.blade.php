<link href="{{ asset('css/components/parts/button/com_line_button.css') }}" rel="stylesheet" type="text/css">
<a class="line-register-wrapper" href="{{ route($routeName, $var) }}">
    <div class="my-2 line-register">
        <img style="height:75px" src="{{ asset('/img/icon/line-icon.jpeg') }}">
        <span>{{ $text }}</span>
    </div>
</a>