<?php

namespace Fengxin2017\ETH\Facades;

use FurqanSiddiqui\Ethereum\RPC\GethRPC;
use Illuminate\Support\Facades\Facade;

/**
 * @see GethRPC
 */
class Geth extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'geth';
    }
}
