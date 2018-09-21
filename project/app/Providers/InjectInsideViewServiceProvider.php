<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class InjectInsideViewServiceProvider extends ServiceProvider
{

    protected $path;
    protected $titles;

    protected $user;

    public function boot() {
        app('view')->composer('partials.nav', function ($view) {
            $title = $this->titles[$this->path] ?? null;
            $view->with(compact('title'));
        });
    }

    public function register() {
        $this->path = $this->app->request->getPathInfo();

        $this->titles = [
            '/' => 'Bienvenue chez nous',
            '/formations' => 'Toutes nos formations',
            '/stages' => 'Tout nos stages',
        ];
    }
}
