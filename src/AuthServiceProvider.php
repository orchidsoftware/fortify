<?php

namespace Orchid\Fortify;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/views' => base_path('resources/views/vendor/orchid-fortify'),
            ], 'views');
        }

        Fortify::loginView(function () {
            return file_exists(resource_path('views/auth/login.blade.php'))
                ? view('auth.login')
                : view('orchid-fortify::auth.login');
        });

        Fortify::registerView(function () {
            return file_exists(resource_path('views/auth/register.blade.php'))
                ? view('auth.register')
                : view('orchid-fortify::auth.register');
        });

        Fortify::requestPasswordResetLinkView(function () {
            return file_exists(resource_path('views/auth/forgot-password.blade.php'))
                ? view('auth.forgot-password')
                : view('orchid-fortify::auth.forgot-password');
        });

        Fortify::resetPasswordView(function () {
            return file_exists(resource_path('views/auth/reset-password.blade.php'))
                ? view('auth.reset-password')
                : view('orchid-fortify::auth.reset-password');
        });

        Fortify::verifyEmailView(function () {
            return file_exists(resource_path('views/auth/verify-email.blade.php'))
                ? view('auth.verify-email')
                : view('orchid-fortify::auth.verify-email');
        });

        Fortify::twoFactorChallengeView(function () {
            return file_exists(resource_path('views/auth/two-factor-challenge.blade.php'))
                ? view('auth.two-factor-challenge')
                : view('orchid-fortify::auth.two-factor-challenge');
        });

        Fortify::confirmPasswordView(function () {
            return file_exists(resource_path('views/auth/confirm-password.blade.php'))
                ? view('auth.confirm-password')
                : view('orchid-fortify::auth.confirm-password');
        });

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'orchid-fortify');
    }
}
