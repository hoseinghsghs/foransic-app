@extends('home.layout.MasterHome')
@section('title', 'ورود')
@section('content')
<!-- login----------------------------------->
<div style="height: 100vh; background-image: url(/assets/admin/images/bg-login.jpg);background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-lg">
                <section class="page-account-box">
                    <div class="col-lg-6 col-md-10 col-xs-12 mx-auto">
                        <div class="ds-userlogin">
                            <div class="account-box">
                                <div class="Login-to-account mt-4">
                                    <div class="account-box-content">
                                        <!-- enter password -->
                                        <form id="login-with-pass" class="form-account">

                                            <h4>ورود</h4>
                                            <div class="text-right">
                                                <div class="form-account-title text-right">
                                                    <label for="username">نام کاربری:</label>
                                                    <input type="text" class="number-email-input" id="username" name="username">
                                                    <small class="text-danger font-weight-bold pr-2 username-error d-block"></small>
                                                </div>
                                                <div class="form-account-title">
                                                    <label for="password">رمز عبور:</label>
                                                    <input type="password" class="number-email-input" id="password" name="password">
                                                    <small class="text-danger font-weight-bold pr-2 password-error d-block"></small>
                                                </div>
                                                <div class="form-auth-row d-flex flex-wrap pt-3 pr-0">
                                                    <div class="col-md-4 col-sm-6 pr-0 mb-2">
                                                        <div class="form-account-title">
                                                            <input type="text" class="number-email-input" id="captcha" placeholder="حاصل کد امنیتی" name="captcha">
                                                            <small class="text-danger font-weight-bold pr-2 captcha-error d-block"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm">
                                                        <div class="captcha d-inline-block">
                                                            {!! captcha_img() !!}
                                                        </div>
                                                        <button type="button" onclick="refreshCaptcha()" class="btn btn-outline-info"><i class="fa fa-refresh" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="form-auth-row d-flex">
                                                    <label for="#" class="ui-checkbox">
                                                        <input type="checkbox" value="1" name="remember" id="remember">
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
                                        <div class="mt-2" align="center" style="color: #ffca00">نسخه آزمایشی</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
<!-- login----------------------------------->
@endsection

@push('scripts')
<script>
    // refresh captcha code
    function refreshCaptcha() {
        $.ajax({
            url: "/refresh-captcha",
            type: 'get',
            dataType: 'html',
            success: function(json) {
                $('.captcha').html(JSON.parse(json).captcha);
            },
            error: function(data) {
                alert('خطا در دریافت کد امنیتی!');
            }
        });
    }

    $('#login-with-pass').submit(function(event) {
        event.preventDefault();

        $('#login-with-pass .btn-login').attr('disabled', true).append(
            '<span class="mr-1"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>');
        $.post("{{ route('login') }}", {
            '_token': "{{ csrf_token() }}",
            'username': $('#username').val(),
            'password': $('#password').val(),
            'captcha': $('#captcha').val(),
            'remember': $('#remember').is(":checked") ? 1 : 0,

        }, function(response, status) {
            Swal.fire({
                text: "خوش آمدید",
                icon: 'success',
                showConfirmButton: false
            });
            window.location.replace(response.redirect);

        }, 'json').fail(function(response) {
            // console.log(response.responseJSON.errors);
            if (response.responseJSON.errors.username) {
                $('#login-with-pass .username-error').html(response.responseJSON.errors.username[0]);
                refreshCaptcha();
            } else {
                $('#login-with-pass .username-error').html('');
            }
            if (response.responseJSON.errors.password) {
                $('#login-with-pass .password-error').html(response.responseJSON.errors.password[0]);
                refreshCaptcha();
            } else {
                $('#login-with-pass .password-error').html('');
            }
            if (response.responseJSON.errors.captcha) {
                if (response.responseJSON.errors.captcha[0] == "validation.captcha") {
                    $('#login-with-pass .captcha-error').html('کد امنیتی اشتباه است');
                } else
                    $('#login-with-pass .captcha-error').html(response.responseJSON.errors.captcha[0]);
                refreshCaptcha();
            } else {
                $('#login-with-pass .captcha-error').html('');
            }
        }).always(function() {
            $('#login-with-pass .btn-login').attr('disabled', false).find('span').remove();
        });
    });
</script>
@endpush