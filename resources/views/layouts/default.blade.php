<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
    <head> 
        @include('includes.front.head')  
        @section('inline-css')
        @show      
    </head>   
    <body class="site_body home-body @yield('body_class')">    	       
       
        @yield('content')        
        @include('includes.front.footer_script')
        @section('inline-js')
        @show
    </body>
</html>