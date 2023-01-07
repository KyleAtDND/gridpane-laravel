<?php

namespace KyleAtDND\GridPane\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @mixin \GridPane\API\HttpClient
 */
class GridPane extends Facade
{

    /**
     * Return facade accessor.
     *
     * @return string
     */
    protected static function getFacadeAccessor() {
        return 'GridPane';
    }
}
