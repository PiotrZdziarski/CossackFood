<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <title>Cossack Food</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

        {{--CSS--}}
         <link rel="stylesheet" href="{{asset('css/app.css')}}">

        {{--FONTS--}}
    </head>
    <body>
        <div id="app" style="min-height: 420vh;">
            <navbar id="mainnav" api_link="@php echo getenv('APP_URL') @endphp"></navbar>
            @yield('content')
            <scrolltop></scrolltop>
        </div>

        {{--VUE--}}
        <script src="{{asset('js/app.js')}}"></script>
    </body>
</html>
