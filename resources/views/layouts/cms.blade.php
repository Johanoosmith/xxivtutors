<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
    <head> 
        @include('includes.front.head')  
        

		<link rel="icon" href="{{ asset(config('settings.favicon', 'uploads/logos/favicon.ico')) }}" type="image/x-icon">
		<link rel="shortcut icon" href="{{ asset(config('settings.favicon', 'uploads/logos/favicon.ico')) }}" type="image/x-icon">
		<!-- <link rel="icon" href="{{asset('front/assets/images/favicon.ico')}}"> -->
		<!-- Bundle -->
		<link rel="stylesheet" href="{{asset('front/assets/css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.1/nouislider.min.css" />
		<link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
        @yield('page-css')
		@section('inline-css')	
		<!-- Style Sheet -->
		<link rel="stylesheet" href="{{asset('front/assets/css/style.css')}}">
		<link rel="stylesheet" href="{{asset('front/assets/css/responsive.css')}}">
		<link rel="stylesheet" href="{{asset('front/assets/css/custom.css')}}">
		

		<!-- Add this to your <head> section -->
			<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
	


		@yield('custom-css')	
        @show      
    </head>   
   
    <body class="site_body home-body bg-lightgrey @yield('body_class')">    	       
	       
       
        @include('includes.front.header')
        @yield('content')
        @include('includes.front.footer')
        @include('includes.front.footer_script')
		@yield('page-js')
		<script>
			$(function () {
				const minPrice = parseInt($('#minPrice').val()) || 0;
				const maxPrice = parseInt($('#maxPrice').val()) || 500;
			
				$("#priceSlider").slider({
					range: true,
					min: 0,
					max: 500,
					values: [minPrice, maxPrice],
					slide: function (event, ui) {
						$("#priceDisplay").text(ui.values[0] + " - " + ui.values[1]);
						$("#minPrice").val(ui.values[0]);
						$("#maxPrice").val(ui.values[1]);
					}
				});
			
				// Set initial text
				$("#priceDisplay").text($("#priceSlider").slider("values", 0) +
					" - " + $("#priceSlider").slider("values", 1));
			});
			</script>  
		@yield('custom-js')
        @section('inline-js')
        @show
    </body>
</html> 