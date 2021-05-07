<!doctype html>
<html lang="ja">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title></title>
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

    <!-- bootstrap
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    -->

    <!-- begin:CSS -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/top.css') }}" rel="stylesheet">
    <!-- end:CSS -->

    <!-- begin:JS -->

    <!-- end:JS -->

    <!-- ファビコン -->
    <link rel="icon" href="/favicon.ico">
    <!-- ホーム画面に追加したときのアイコン -->
    <link rel="apple-touch-icon" href="icon.png">
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
    @yield('content')
    <script src="{{ mix('js/app.js') }}" defer></script>
  </body>
</html>
