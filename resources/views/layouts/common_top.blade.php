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
    <title>面接図鑑｜就活生の面接が見放題！</title>
    <meta name="description" content="就活において、避けては通れない面接。面接図鑑は、そんな面接に対する過度な不安を払拭するためのサービスです。実際の人事と面接の場数をこなせるだけでなく、採点とアドバイス付きで、面接力をどんどんアップデート。他の就活生の面接も見放題なので、「受かる」面接を徹底解剖できます。">
    <meta name="viewport" content="width=device-width">

    <!-- begin:ODP -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="面接図鑑|トップページ">
    <meta property="og:description" content="就活において避けては通れない面接。面接図鑑は、そんな面接に対する過度な不安を払拭するためのサービスです。実際の人事と面接の場数をこなせるだけでなく、採点とアドバイス付きで、面接力をどんどんアップデート。他の就活生の面接も見放題なので「受かる」面接を徹底解剖できます。">
    <meta property="og:site_name" content="面接図鑑">
    <meta property="og:url" content="https://mensetsu-zukan.online/">
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
