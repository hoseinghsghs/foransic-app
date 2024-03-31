<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1">
<meta name="author" content="ghasemi rajabi" />
<!--=============== favicons ===============-->
{{-- <meta name="copyright" content="meta_webs" />
<meta name="designer" content="hosein ghasemi, amir rajabi" />
<meta name="apple-mobile-web-app-title" content="meta_webs">
<meta name="application-name" content="meta_webs"> --}}

<meta property="business:contact_data:website" content="{{ env('APP_URL') }}">
{{-- <link rel="icon" href="{{ asset('images/logo.ico') }}"> --}}

<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- Google tag (gtag.js) -->
{{-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-230148298-3"></script> --}}
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-230148298-3');
</script>
<title> @yield('title')
</title>
 <link rel="stylesheet" href="{{ asset('css/home.css') }}">
