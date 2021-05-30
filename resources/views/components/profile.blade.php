<link href="{{ asset('css/components/com_profile.css') }}" rel="stylesheet" type="text/css">
<div class="container_profile">
  <img class="container_profile_img" src="{{ asset($imagePath) }}" alt="プロフィール画像">
  <p class="container_profile_name">
    {{ $userName }}
    {{ $nickName }}
  </p>
  <p class="container_profile_category">
    {{ $description }}
  </p>
  <p class="container_profile_detail">
    {{ $introduction }}
  </p>
</div>
