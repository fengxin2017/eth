<?php

namespace Fengxin2017\ETH\Facades;

use Fengxin2017\ETH\Erc20Manager;
use Illuminate\Support\Facades\Facade;

/**
 * @see Erc20Manager
 */
class Erc20 extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Erc20Manager::class;
    }
}
