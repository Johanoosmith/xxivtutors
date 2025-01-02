<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
    <head> 
        @include('includes.front.head')  
        @section('inline-css')

            <link rel="icon" href="{{ asset(config('settings.favicon', 'uploads/logos/favicon.ico')) }}" type="image/x-icon">
            <link rel="shortcut icon" href="{{ asset(config('settings.favicon', 'uploads/logos/favicon.ico')) }}" type="image/x-icon">
            <!-- <link rel="icon" href="{{asset('front/assets/images/favicon.ico')}}"> -->
            <!-- Bundle -->
            <link rel="stylesheet" href="{{asset('front/assets/css/bootstrap.min.css') }}">
            <!-- Style Sheet -->
            <link rel="stylesheet" href="{{asset('front/assets/css/style.css')}}">
            <link rel="stylesheet" href="{{asset('front/assets/css/responsive.css')}}">

        @show      
    </head>   
    <body class="site_body home-body bg-lightgrey @yield('body_class')">    	       
       
        @include('includes.front.header')
        @yield('content')
        @include('includes.front.footer')
        @include('includes.front.footer_script')
        @section('inline-js')
        @show
    </body>
</html> 