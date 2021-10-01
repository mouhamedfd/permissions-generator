<?php

namespace Mouhamedfd\PermissionsGenerator;

use Illuminate\Support\Facades\Artisan;

class PermissionsGenerator
{

    public function simulate()
    {
        $exitCode = Artisan::call('permission:generate');
    }

    public function database()
    {
        $exitCode = Artisan::call('permission:generate', [
            '--action' => 'database',
        ]);
    }

    public function controllers()
    {
        $exitCode = Artisan::call('permission:generate', [
            '--action' => 'controllers',
        ]);
    }
}
