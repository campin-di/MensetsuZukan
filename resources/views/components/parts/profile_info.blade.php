<link href="{{ asset('css/components/parts/com_profile_info.css') }}" rel="stylesheet" type="text/css">
<div class="profile profile-st-user">
  <a href="{{ route($isHr.'stpage', $video['stId']) }}">
    <img src="{{ asset($stImagePath) }}">
    {{ $video['stNickname'] }}<br>
  </a>
</div>
<div class="profile profile-hr-user">
  <a href="{{ route($isHr.'hrpage', $video['hrId']) }}">
    <img src="{{ asset($hrImagePath) }}">
    {{ $video['hrName'] }}
  </a>
</div>
