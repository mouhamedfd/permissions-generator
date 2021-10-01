<?php

namespace Mouhamedfd\PermissionsGenerator;

use Illuminate\Support\ServiceProvider;
use Mouhamedfd\PermissionsGenerator\Console\Commands\PermissionsGeneratorCommand;

class PermissionsGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/permissions-generator.php', 'permissions-generator');

        // Register the service the package provides.
        $this->app->singleton('permissions-generator', function ($app) {
            return new PermissionsGenerator;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['permissions-generator'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/permissions-generator.php' => config_path('permissions-generator.php'),
        ], 'permissions-generator.config');

        $this->commands([
            PermissionsGeneratorCommand::class,
        ]);
    }
}
