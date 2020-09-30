<?php

namespace Fengxin2017\ETH\Facades;

use FurqanSiddiqui\Ethereum\RPC\InfuraAPI;
use Illuminate\Support\Facades\Facade;

/**
 * @see InfuraAPI
 */
class Infura extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'infura';
    }
}
