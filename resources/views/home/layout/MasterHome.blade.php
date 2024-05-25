<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    @include('home.partial.Head')
    @stack('styles')
    @livewireStyles()
</head>
<body class="container-main-xlg mx-auto">
    @yield('content')
    <script type="text/javascript" src="{{ asset('js/home.js') }}"></script>
    @livewireScripts()
    @include('sweetalert::alert')
    @stack('scripts')
    <script>
        @if (session('status'))
            @if (session('status') == 'profile-information-updated')
                Swal.fire({
                    text: "حساب کاربری با موفقیت ویرایش شد",
                    icon: 'success',
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-right',
                    timer: 5000,
                    timerProgressBar: true,
                })
            @elseif (session('status') == 'verification-link-sent')
                Swal.fire({
                    title: 'لینک ارسال شد',
                    text: 'ایمیل خود(اسپم) را بررسی کنید و بر روی لینک تایید ایمیل کلیک کنید.',
                    icon: 'success',
                    confirmButtonText: 'تایید',
                })
            @elseif (session('status') == 'passwords.reset')
                Swal.fire({
                    text: 'رمز عبور با موفقیت ذخیره شد.',
                    icon: 'success',
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-right',
                    timer: 5000,
                    timerProgressBar: true,
                })
            @else
                Swal.fire({
                    text: "{{ session('status') }}",
                    icon: 'success',
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-right',
                    timer: 5000,
                    timerProgressBar: true,
                })
            @endif
        @endif
    </script>
</body>
</html>
