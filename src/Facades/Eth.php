<?php

namespace Fengxin2017\ETH\Facades;

use FurqanSiddiqui\Ethereum\Ethereum;
use Illuminate\Support\Facades\Facade;

/**
 * @see Ethereum
 */
class Eth extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'eth';
    }
}
