<?php

namespace Mouhamedfd\PermissionsGenerator\Tests;

use Illuminate\Support\Facades\Route;
use Mouhamedfd\PermissionsGenerator\PermissionsGeneratorServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        // Route::get('/posts/list', [App\Http\Controllers\PostController::class, 'list'])->name('posts.list');
        // Route::resource('posts', App\Http\Controllers\PostController::class);

    // additional setup
    }

    protected function defineRoutes($router)
    {
        // Define routes.
        $router->post('/posts/manage', [App\Http\Controllers\PostController::class, 'manage'])->name('posts.manage');
        $router->get('/posts/list', [App\Http\Controllers\PostController::class, 'list'])->name('posts.list');
        $router->resource('posts', App\Http\Controllers\PostController::class);
    }

    protected function getPackageProviders($app)
    {
        return [
            PermissionsGeneratorServiceProvider::class,    ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }
}
