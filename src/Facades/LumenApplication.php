<?php

namespace Pigvelop\LumenApplication\Facades;

use Illuminate\Support\Facades\Facade;

class LumenApplication extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'lumen-application';
    }
}
