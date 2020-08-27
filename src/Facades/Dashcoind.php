<?php

namespace Gegosoft\Dashcoin\Facades;

use Illuminate\Support\Facades\Facade;

class Dashcoind extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'dashcoind';
    }
}
