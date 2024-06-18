<!doctype html>

<html class="no-js " lang="fa" dir="rtl">

<head>
    @include('admin.partial.Head')
    <link rel="stylesheet" href="{{ mix('css/admin.css') }}">
    @stack('styles')
    @livewireStyles()
</head>

<body class="theme-blush" id="cheack_collapsed">

    <!-- Page Loader -->
    @include('admin.partial.PageLoader')
    <!-- Overlay For Sidebars -->
    <div class=" overlay">
    </div>

    <!-- Main Search -->
    @include('admin.partial.MainSearch')
    <!-- Right Icon menu Sidebar -->
    @include('admin.partial.RightIconSidebar')

    <!-- Left Sidebar -->
    @include('admin.partial.LeftSidebar')

    <!-- Right Sidebar -->
    @include('admin.partial.RightSidebar')
    <!-- Main Content -->

    @yield('Content')

    <!-- Jquery Core Js -->
    <script src="{{ asset('js/admin.js') }}"></script>
    {{--    @vite('resources/js/admin.js') --}}

    @include('sweetalert::alert')
{{--    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])--}}

    <script>
        @if (session('status'))
            swal({
                text: "{{ session('status') }}",
                icon: 'success',
                button: 'تایید',
                timer: 3000,
                timerProgressBar: true,
            })
        @endif



        window.addEventListener('say-sound', event => {
            var audio = new Audio(window.location.origin + '/assets/admin/sound/beep.mp3');
            audio.play();

            $('.notify').css({
                "display": "block"
            });

            $.notify({
                message: "رویداد جدید ثبت شد."
            });
        })
    </script>

    @livewireScripts()

    @stack('scripts')
</body>

</html>
