<?php

namespace KyleAtDND\Gridpane\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @mixin \Gridpane\Api\HttpClient
 */
class Gridpane extends Facade
{
    /**
     * Return facade accessor.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Gridpane';
    }
}
