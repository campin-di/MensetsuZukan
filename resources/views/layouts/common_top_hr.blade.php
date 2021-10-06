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
    <title>面接図鑑 | 採用担当者様</title>
    <meta name="description" content="面接図鑑は、実際の人事と面接を行うことで、面接力をどんどんアップデートできるサービスです。さらに全国の就活生の面接も得点＆アドバイス付きで見放題！">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Cache-Control" content="no-cache">

    <!-- begin:ODP -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="面接図鑑|採用担当者様">
    <meta property="og:site_name" content="面接図鑑">
    <meta property="og:url" content="https://mensetsu-zukan.online/">
    <!-- end:ODP -->

    <!-- begin:Twitter ODP -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@mensetsuZukan" />
    <meta name="twitter:title" content="面接図鑑" />
    <meta name="twitter:description" content="全国の就活生の面接を分析＆模擬面接で面接力をアップさせよう！" />
    <meta name="twitter:image" content="{{ asset('/img/top/Twitter.jpg') }}" />
    <!-- end:Twitter ODP -->

    <!-- bootstrap
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    -->

    <!-- begin:CSS -->
    <link href="{{ asset('/css/app-ori.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/top_hr.css') }}" rel="stylesheet">
    <!-- end:CSS -->

    <!-- begin:JS -->

    <!-- end:JS -->

    <!-- ファビコン -->
    <link rel="icon" href="{{ asset('/img/logo/favicon.ico') }}" id="favicon">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/img/logo/apple-touch-icon.png') }}">
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
