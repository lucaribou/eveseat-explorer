<?php

namespace Seat\Cara\Explorer;

use Illuminate\Support\ServiceProvider;

class ExplorerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->addRoutes();
        $this->addViews();
        $this->addTranslations();
        $this->addMigrations();
        $this->addAssets();
        $this->addMiddlewares();
    }

    public function addMiddlewares()
    {
        $this->app['router']->middleware('sso-auth', 'Seat\Cara\Explorer\Http\Middleware\SsoAuth');
        $this->app['router']->middleware('explorer-settings', 'Seat\Cara\Explorer\Http\Middleware\Settings');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/Config/package.sidebar.php', 'package.sidebar');
        $this->mergeConfigFrom(__DIR__ . '/Config/explorer.permissions.php', 'web.permissions');
    }

    private function addRoutes()
    {
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
    }

    private function addViews()
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'explorer');
    }

    private function addTranslations()
    {
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'explorer');
    }

    private function addMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }

    private function addAssets()
    {
        $this->publishes([
            __DIR__ . '/resources/assets/css' => public_path('web/css'),
            __DIR__ . '/resources/assets/js' => public_path('web/js')
        ]);
    }

}