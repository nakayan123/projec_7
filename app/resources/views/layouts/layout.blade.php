<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '←WATCH SPORTS→') }}</title>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('stylesheet')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" id="nav">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}" id="title">
                ←WATCH SPORTS→
                </a>
            </div>
            <div class="my-navbar-cintrol">
                @if(Auth::check())
                <span class="my-navbar-item">{{ Auth::user()->name }}</span>
                /
                <a href="#" id="logout" class="my-navbar-item">ログアウト</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
                    @csrf
                </form>
                <script>
                    document.getElementById('logout').addEventListener('click',function(event){
                        event.preventDefault();
                        document.getElementById('logout-form').submit();
                    });
                </script>
                    @else
                    <a class="my-navbar-item" href="{{ route('login')}}">ログイン</a>
                    /
                    <a class="my-navbar-item" href="{{ route('register')}}">会員登録</a>
                    @endif
            </div> 
        </nav>
        @yield('content')
    </div>
</body>

<style>
    body{
        background-image: url(/image/IMG2.jpg);
        width: 100vw;
    }
    #btn {
     margin-right: 10px;
    }
    @import url('https://fonts.googleapis.com/css?family=Amatic+SC:700');
    #title{
        font-family: 'Anton', sans-serif;
    }
</style>
</html>