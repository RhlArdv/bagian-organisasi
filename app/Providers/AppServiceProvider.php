<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Strong password policy — fixes WEB-833357 (Weak Password Policy / CWE-521).
        // Requires: min 8 chars, at least one uppercase, one lowercase,
        // one digit, and one symbol. Common passwords like "password" are rejected.
        Password::defaults(function () {
            return Password::min(8)
                ->mixedCase()   // at least one uppercase AND one lowercase letter
                ->numbers()     // at least one digit
                ->symbols()     // at least one special character
                ->uncompromised(); // reject passwords in known breach databases (via haveibeenpwned.com)
        });
    }
}
