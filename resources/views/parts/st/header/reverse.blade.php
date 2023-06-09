<nav class="header-wrapper navbar navbar-expand-md navbar-light">
  <div class="header container">
    <a class="header-logo navbar-brand" href="{{ url('/') }}">
      <img class="firstview-logo" src="{{ asset('/img/logo/logo_white.png') }}" alt="ロゴ">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Left Side Of Navbar -->
      <ul class="navbar-nav mr-auto">

      </ul>

      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">ログイン</a>
          </li>
          @if (Route::has('register'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register.choice') }}">新規会員登録</a>
            </li>
          @endif
        @else
          <li class="header-dropdown nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              {{ Auth::user()->name }}
            </a>

            <div class="header-dropdown-menu dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('mypage') }}">
                マイページ
              </a>
              <a class="dropdown-item" href="{{ route('interview.chat.list') }}">
                メッセージ
              </a>
              <a class="dropdown-item" href="{{ route('interview.search') }}">
                模擬面接の申し込み
              </a>
              <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                ログアウト
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </div>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>
