<?php

namespace ArungPIsyadi\SiBex\Facades;

use Illuminate\Support\Facades\Facade;

class SiBex extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'sibex';
    }
}
