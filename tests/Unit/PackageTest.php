<?php

namespace Mouhamedfd\PermissionsGenerator\Tests\Unit;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Mouhamedfd\PermissionsGenerator\Tests\TestCase;
use Spatie\Permission\Models\Permission;

class PackageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    //    public function test_example()
    //  {
    //$response = $this->get('/');

    //$response->assertStatus(200);
    //}

    /** @test */
    public function test_install_command_copies_the_configuration()
    {
        // make sure we're starting from a clean state
        echo 'config:'.config_path().PHP_EOL;
        if (File::exists(config_path('permissions-generator.php'))) {
            unlink(config_path('permissions-generator.php'));
        }

        $this->assertFalse(File::exists(config_path('permissions-generator.php')));

        Artisan::call('vendor:publish --tag=permissions-generator.config');

        $this->assertTrue(File::exists(config_path('permissions-generator.php')));
    }

    public function test_create_controller_and_model()
    {
        echo 'App Path:'.app_path().PHP_EOL;

        if (File::exists(app_path('Http/Controllers/PostController.php'))) {
            unlink(app_path('Http/Controllers/PostController.php'));
        }
        if (File::exists(app_path('Models/Post.php'))) {
            unlink(app_path('Models/Post.php'));
        }
        $this->assertFalse(File::exists(app_path('Http/Controllers/PostController.php')));
        $this->assertFalse(File::exists(app_path('Models/Post.php')));

        Artisan::call('make:controller PostController --resource --model=Post --quiet');

        $this->assertTrue(File::exists(app_path('Http/Controllers/PostController.php')));
        $this->assertTrue(File::exists(app_path('Models/Post.php')));
    }

    public function test_create_permission()
    {
        Artisan::call('permission:generate --action=controllers');
        $this->assertTrue(File::exists(app_path('Http/Controllers/PostController.php')));
        $controller = File::get(app_path('Http/Controllers/PostController.php'));
        $this->assertTrue(str_contains($controller, '$this->middleware(\'auth\');'));
        $this->assertTrue(str_contains($controller, '$this->middleware([\'permission:posts.list\'])->only([\'list\']);'));
        $this->assertTrue(str_contains($controller, '$this->middleware([\'permission:posts.index\'])->only([\'index\']);'));
        $this->assertTrue(str_contains($controller, '$this->middleware([\'permission:posts.create\'])->only([\'create\']);'));
        $this->assertTrue(str_contains($controller, '$this->middleware([\'permission:posts.store\'])->only([\'store\']);'));
        $this->assertTrue(str_contains($controller, '$this->middleware([\'permission:posts.show\'])->only([\'show\']);'));
        $this->assertTrue(str_contains($controller, '$this->middleware([\'permission:posts.edit\'])->only([\'edit\']);'));
        $this->assertTrue(str_contains($controller, '$this->middleware([\'permission:posts.update\'])->only([\'update\']);'));
        $this->assertTrue(str_contains($controller, '$this->middleware([\'permission:posts.destroy\'])->only([\'destroy\']);'));
    }

    public function test_database()
    {
        //$rootpath = dirname(dirname(dirname(__FILE__)));
        echo 'Path'.__DIR__.PHP_EOL;
        if (File::exists(base_path('config/permission.php'))) {
            unlink(base_path('config/permission.php'));
        }
        $this->assertFalse(File::exists(base_path('config/permission.php')));
        // File::copy($rootpath . '/vendor/spatie/laravel-permission/config/permission.php', base_path('config/permission.php'));
        File::copy(__DIR__.'/../../vendor/spatie/laravel-permission/config/permission.php', base_path('config/permission.php'));
        $this->assertTrue(File::exists(base_path('config/permission.php')));
        Artisan::call('config:clear');
        if (File::exists(base_path('database/migrations/2018_01_01_000000_create_permission_tables.php'))) {
            unlink(base_path('database/migrations/2018_01_01_000000_create_permission_tables.php'));
        }
        $this->assertFalse(File::exists(base_path('database/migrations/2018_01_01_000000_create_permission_tables.php')));
        // File::copy($rootpath . '/vendor/spatie/laravel-permission/database/migrations/create_permission_tables.php.stub', base_path('database/migrations/2018_01_01_000000_create_permission_tables.php'));
        File::copy(__DIR__.'/../../vendor/spatie/laravel-permission/database/migrations/create_permission_tables.php.stub', base_path('database/migrations/2018_01_01_000000_create_permission_tables.php'));
        $this->assertTrue(File::exists(base_path('database/migrations/2018_01_01_000000_create_permission_tables.php')));
        Artisan::call('cache:clear');
        Artisan::call('migrate');
        Artisan::call('permission:generate --action=database');
        $permissions = Permission::get();
        foreach ($permissions as $key => $permission) {
            $this->assertTrue(
                in_array($permission->name, [
                    'posts.manage',
                    'posts.list',
                    'posts.index',
                    'posts.create',
                    'posts.store',
                    'posts.show',
                    'posts.edit',
                    'posts.update',
                    'posts.destroy',
                ])
            );
        }
    }
}
