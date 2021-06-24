<!doctype html>
<html lang="ja">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>@yield('title') | {{ config('app.name') }}</title>
    @hasSection('description')
      <meta name="description" itemprop="description" content="@yield('description')">
    @else
      <meta name="description" itemprop="description" content="ゼミ・研究室口コミサイト|みんラボ">
    @endif
    <meta name="viewport" content="width=device-width">

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
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/st/parts/header_reverse.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/st/parts/footer.css') }}" rel="stylesheet">
    <!-- end:CSS -->

    <!-- begin:JS -->

    <!-- end:JS -->

    <!-- ファビコン -->
    <link rel="icon" href="{{ asset('/img/logo/favicon.ico') }}">
    <!-- ホーム画面に追加したときのアイコン -->
    <link rel="apple-touch-icon" href="{{ asset('/img/logo/favicon.png') }}">
    <!-- Windows用アイコン -->
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
  </head>
  <body>
    @include('parts.st.header.reverse')
    <div id="template-content">
      @yield('content')
    </div>
    @include('parts.st.footer.normal')
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="https://js.stripe.com/v3/"></script>
  </body>
</html>
