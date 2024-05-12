<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;

use App\Http\Responses\PasswordResetResponse;
use App\Models\Event;
use App\Models\User;
use Laravel\Fortify\Contracts\PasswordResetResponse as PasswordResetResponseContract;
use App\Http\Responses\PasswordUpdateResponse;
use Laravel\Fortify\Contracts\PasswordUpdateResponse as PasswordUpdateResponseContract;


use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LogoutResponse;
use Spatie\Permission\Models\Role;


class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Fortify::ignoreRoutes();  //to ignore the fortify routes and use routes/fortify.php
        $this->app->instance(LogoutResponse::class, new class implements LogoutResponse {
            public function toResponse($request)
            {
                return redirect()->back();
            }
        });

        $this->app->instance(LoginResponse::class, new class implements LoginResponse {
            public function toResponse($request)
            {
                $roles=Role::all()->pluck('name')->toArray();
                if ($request->user()->hasRole($roles)){
                    if (request()->session()->get('url.intended') && str_contains(request()->session()->get('url.intended'),'Admin-panel/managment')){
                        $redirect=request()->session()->get('url.intended');
                    }else{
                        $redirect=route('admin.home');
                    }
                }else{
                    $redirect=route('user.home');
                }
                return $request->wantsJson()
                    ? response()->json(['two_factor' => false, 'redirect' => $redirect])
                    : (auth()->user()->hasRole($roles) ? redirect()->route('admin.home') : redirect()->route('user.home'));
            }
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        Fortify::loginView(function () {
            return view('home.auth.login');
        });
        Fortify::registerView(function () {
            return view('home.auth.login');
        });
        Fortify::resetPasswordView(function ($request) {
            return view('home.auth.reset-password', ['request' => $request]);
        });
        Fortify::verifyEmailView(function () {
            return view('home.auth.verify-email');
        });
        Fortify::confirmPasswordView(function () {
            return view('home.auth.confirm-password');
        });
        $this->app->singleton(PasswordUpdateResponseContract::class, PasswordUpdateResponse::class);


        Fortify::authenticateUsing(function (Request $request) {
            $request->validate(['captcha' => ['required','captcha']]);
            $user = User::where('email', $request->username)->orWhere('cellphone', $request->username)->first();

            if ($user &&
                Hash::check($request->password, $user->password)) {
                $event = Event::create([
                    'title' => 'کاربر وارد سایت شد',
                    'body' => 'کاربر' . " " . $user->cellphone,
                    'user_id' => $user->id,
                    'eventable_id' => $user->id,
                    'eventable_type' => User::class,
                ]);
                return $user;
            }
        });

        RateLimiter::for('login', function (Request $request) {
            $email = (string)$request->email;

            return Limit::perMinute(5)->by($email . $request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        $this->app->singleton(PasswordResetResponseContract::class, PasswordResetResponse::class);

    }
}
