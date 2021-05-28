<link href="{{ asset('css/components/com_profile_info.css') }}" rel="stylesheet" type="text/css">
<div class="profile profile-st-user">
  <a href="{{ route('mypage.theirPage', $video['stId']) }}">
    <img src="{{ asset('/img/icon/st-unset.png') }}">
    {{ $video['stNickname'] }}<br>
  </a>
</div>
<div class="profile profile-hr-user">
  <a href="{{ route('hr_mypage', $video['hrId']) }}">
    <img src="{{ asset('/img/icon/hr-unset.png') }}">
    {{ $video['hrName'] }}
  </a>
</div>
