<?php

namespace Dynaform\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Class DynaformFacade
 * @package Dynaform\Facade
 */
class DynaformFacade extends Facade
{
    /**
     * Get the registered name of the component.
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'dynaform';
    }
}
