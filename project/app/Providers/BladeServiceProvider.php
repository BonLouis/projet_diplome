<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        /**
         * @var
         */
        \Blade::directive('var', function ($expression) {
            $p = explode(' = ', $expression);
            return "<?php {$p[0]} = {$p[1]}; ?>";
        });
        /**
         * @admin,
         * @else,
         * @endadmin
         */
        \Blade::if('admin', function () {
            return auth()->check() && auth()->user()->isAdmin();
        });
    }
}
