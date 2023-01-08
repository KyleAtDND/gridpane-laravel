<?php

namespace KyleWLawrence\GridPane\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @mixin \GridPane\Api\HttpClient
 */
class GridPane extends Facade
{
    /**
     * Return facade accessor.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'GridPane';
    }
}
