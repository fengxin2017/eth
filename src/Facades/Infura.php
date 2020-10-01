<?php

namespace Fengxin2017\ETH\Facades;

use FurqanSiddiqui\Ethereum\RPC\InfuraAPI;
use Illuminate\Support\Facades\Facade;

/**
 * @method static mixed call(string $method, array $params = null)
 * @method static InfuraAPI debug()
 * @method static InfuraAPI ignoreSSL()
 * @method static InfuraAPI setTimeout(int $connectTimeout, ?int $timeOut = null)
 * @method static InfuraAPI setNoncePrefix(string $prefix)
 * @method static InfuraAPI httpAuthBasic(string $user, string $pass)
 * @method static InfuraAPI crossCheckReqIds(bool $trigger)
 * @method static int eth_blockNumber()
 * @method static string eth_getBalance(string $accountId, string $scope = "latest")
 *
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
