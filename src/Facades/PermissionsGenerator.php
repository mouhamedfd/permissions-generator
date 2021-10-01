<?php

namespace Mouhamedfd\PermissionsGenerator\Facades;

use Illuminate\Support\Facades\Facade;

class PermissionsGenerator extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'permissions-generator';
    }
}
