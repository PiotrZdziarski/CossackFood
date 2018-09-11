<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <title>@yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Great+Vibes&amp;subset=latin-ext" rel="stylesheet">

        {{--CSS--}}
         <link rel="stylesheet" href="{{asset('css/app.css')}}">
         <link rel="stylesheet" href="{{asset('css/fontello.css')}}">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

        {{--FONTS--}}
    </head>
    <body>
        <div id="app">
            <navbar id="mainnav" api_link="@php echo getenv('APP_URL') @endphp"></navbar>
            @yield('content')
            <scrolltop></scrolltop>
            <mainfooter api_link="@php echo getenv('APP_URL') @endphp"></mainfooter>
        </div>

        {{--VUE--}}
        <script src="{{asset('js/app.js')}}"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init();
        </script>
    </body>
</html>
