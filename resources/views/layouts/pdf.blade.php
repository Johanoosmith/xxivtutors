<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
    <head>
    <link href="{{ URL::asset('front/assets/css/bootstrap.min.css') }}"rel="stylesheet">
    <link href="{{ URL::asset('front/assets/css/style.css') }}"rel="stylesheet">
    </head>   
    <body class="site_body home-body">
        @yield('content')
    </body>
</html>