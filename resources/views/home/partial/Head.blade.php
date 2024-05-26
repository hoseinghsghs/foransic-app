<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1">
<meta property="business:contact_data:website" content="{{ env('APP_URL') }}">
{{-- <link rel="icon" href="{{ asset('images/logo.ico') }}"> --}}
<meta name="csrf-token" content="{{ csrf_token() }}" />
<title> @yield('title')
</title>
 <link rel="stylesheet" href="{{ asset('css/home.css') }}">
