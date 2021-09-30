<!doctype html>
<html lang="ja">
  <head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-27V11WJ3DJ"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-27V11WJ3DJ');
    </script>
    
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>@yield('title') | {{ config('app.name') }}</title>
    @hasSection('description')
      <meta name="description" itemprop="description" content="@yield('description')">
    @else
      <meta name="description" itemprop="description" content="面接図鑑|就活生の面接が見放題！">
    @endif
    <meta name="viewport" content="width=device-width,user-scalable=no">
    
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">

    <!-- begin:ODP -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="">
    <meta property="og:description" content="">
    <meta property="og:site_name" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <meta property="og:app_id" content="">
    <!-- end:ODP -->

    <!-- bootstrap -->

    <!-- begin:CSS -->
    <link href="{{ asset('/css/app-ori.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/st/parts/header.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/st/parts/bottom_menu.css') }}" rel="stylesheet">
    <!-- end:CSS -->

    <!-- begin:JS -->
  
    <!-- end:JS -->

    <!-- ファビコン -->
    <link rel="icon" href="{{ asset('/img/logo/favicon.ico') }}" id="favicon">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/img/logo/apple-touch-icon.png') }}">
    
    <!--
    <meta name="application-name" content="{サイト名}"/>
    <meta name="msapplication-square70x70logo" content="small.jpg"/>
    <meta name="msapplication-square150x150logo" content="medium.jpg"/>
    <meta name="msapplication-wide310x150logo" content="wide.jpg"/>
    <meta name="msapplication-square310x310logo" content="large.jpg"/>
    <meta name="msapplication-TileColor" content="#FAA500"/>
    -->

    <!-- ヘッダー上部の色を指定 -->
    <meta name="theme-color" content="#fafafa">
    
    @if(request()->path()==='user/subscription')
        @include('parts.stripe.head')
    @endif
  </head>
  <body>
    <div class="background-image">
      <div class="white">
        @include('parts.st.header.normal')
        <div id="template-content">
          @yield('content')
        </div>
        @auth
          @include('parts.st.footer.bottom_menu')
        @endauth
        
      </div>
    </div>
    @if(request()->path()==='user/subscription')
        @include('parts.stripe.script')
    @else
      <script src="{{ mix('js/app.js') }}" defer></script>
    @endif
  </body>
  @guest
    <style type="text/css">
      .fixed-button {
        bottom: 0px !important;
      }
    </style>
  @endguest
</html>
