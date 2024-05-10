@extends('home.layout.MasterHome')
@section('title', 'ورود')
@section('content')
    <!-- login----------------------------------->
    <div class="container">
        <div class="row">
            <div class="col-lg">
                <section class="page-account-box">
                    <div class="col-lg-6 col-md-10 col-xs-12 mx-auto">
                        <div class="ds-userlogin">
                            {{-- <a href="#" class="account-box-logo"
                                style="background: url({{ asset('storage/logo/' . $setting->logo) }}) no-repeat;background-size: contain;">{{ $setting->title }}</a> --}}
                            <div class="account-box">
                                <div class="Login-to-account mt-4">
                                    <div class="account-box-content">
                                        <!-- enter password -->
                                        <form id="login-with-pass" class="form-account">
                                            <h4>ورود</h4>
                                            <div class="form-account-title text-right">
                                                <label for="username">نام کاربری:</label>
                                                <input type="text" class="number-email-input" id="username"
                                                       name="username">
                                                <small
                                                    class="text-danger font-weight-bold pr-2 username-error d-block"></small>
                                            </div>
                                            <div class="text-right">
                                                <div class="form-account-title">
                                                    <label for="password">رمز عبور:</label>
                                                    <input type="password" class="number-email-input" id="password"
                                                        name="password">
                                                    <small
                                                        class="text-danger font-weight-bold pr-2 password-error d-block"></small>
                                                </div>
                                                <div class="form-auth-row d-flex">
                                                    <label for="#" class="ui-checkbox">
                                                        <input type="checkbox" value="1" name="remember"
                                                            id="remember">
                                                        <span class="ui-checkbox-check"></span>
                                                    </label>
                                                    <label for="remember" class="remember-me mr-0">مرا به خاطر
                                                        بسپار</label>
                                                </div>
                                                <div class="form-row-account text-center">
                                                    <button class="btn btn-primary btn-login col-lg-4 col-md-6" type="submit">ورود
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- login----------------------------------->
@endsection

@push('scripts')
    <script>
        // login with pass if user has password
        $('#login-with-pass').submit(function(event) {
            event.preventDefault();
            var form = $(this);

            $('#login-with-pass .btn-login').attr('disabled', true).append(
                '<span class="mr-1"><i class="fa fa-spinner fa-spin"></i></span>');
            $.post("{{ route('login') }}", {
                '_token': "{{ csrf_token() }}",
                'username': $('#username').val(),
                'password': $('#password').val(),
                'remember': $('#remember').is(":checked") ? 1 : 0,

            }, function(response, status) {
                Swal.fire({
                    text: "خوش آمدید",
                    icon: 'success',
                    showConfirmButton: false
                });
                window.location.replace(response.redirect);

            }, 'json').fail(function(response) {
                console.log(response.responseJSON.errors);

                if (response.responseJSON.errors.username) {
                    $('#login-with-pass .username-error').html(response.responseJSON.errors.username[0]);
                } else {
                    $('#login-with-pass .username-error').html('');
                }
                if (response.responseJSON.errors.password) {
                    $('#login-with-pass .password-error').html(response.responseJSON.errors.password[0]);
                } else {
                    $('#login-with-pass .password-error').html('');
                }
            }).always(function() {
                $('#login-with-pass .btn-login').attr('disabled', false).find('span').remove();
            });
        });
    </script>
@endpush
