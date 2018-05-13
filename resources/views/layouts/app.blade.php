<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <meta property="og:title" content="{{config('app.name')}}">
    <meta name="twitter:title" content="{{config('app.name')}}">
    <meta property="og:description" content="Googleサジェストワード導出ツールです。サジェストワードを再帰的に全て導出してきます。">
    <meta name="twitter:description" content="Googleサジェストワード導出ツールです。サジェストワードを再帰的に全て導出してきます。">
    <meta name="description" content="Googleサジェストワード導出ツールです。サジェストワードを再帰的に全て導出してきます。">


    <!-- あとで編集する -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{url()->current()}}">
    <meta property="og:image" content="{{url('/eyecatch.png')}}">
    <meta name="twitter:image" content="{{url('/eyecatch.png')}}">
    <meta property="og:site_name" content="{{config('app.name','Laravel')}}">
    <meta property="og:locale" content="ja_JP">
    <meta property="fb:app_id" content="339751459830292">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{url()->current()}}">
    <meta name="twitter:domain" content="svschool.jp">
    <meta name="twitter:creator" content="@ryokurosu">
    <meta name="twitter:site" content="@ryokurosu">
    <link rel="canonical" href="{{ url()->current() }}">


    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <link rel="shortcut icon" href="{{url('/favicon.ico')}}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{url('/apple-touch-icon.png')}}" sizes="180x180">
    <link rel="icon" href="{{url('/favicon192.png')}}" sizes="192x192">　
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <footer id="footer">
        Powered By <a href="https://twitter.com/ryokurosu">@ryokurosu</a>
    </footer>
</body>
</html>
