<?php

namespace Chintanlin\GeoIP2\Facades;

use Illuminate\Support\Facades\Facade;

class GeoIP2 extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'geoip2';
    }
}
