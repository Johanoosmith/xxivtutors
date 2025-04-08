    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">    
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="robots" content="noindex,nofollow" />
    <title> @yield('meta_title')</title>
    <meta name="description" content="@yield('meta_desc')">
    <link rel="canonical" href="@yield('meta_page_url')" />

 
    <script type="text/javascript">
        var APP_URL = {!! json_encode(url('/')) !!};
        var MEDIA_URL = {!! json_encode(url('public/')) !!};
		let SITE_CURRENCY = "{{ config('constants.CURRENCY_SYMBOL') }}";
		let STUDENT_RATE_PERCENT = "{{ config('constants.SITE.STUDENT_RATE') }}";
	</script>

    
