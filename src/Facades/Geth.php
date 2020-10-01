<?php

namespace Fengxin2017\ETH\Facades;

use FurqanSiddiqui\Ethereum\RPC\GethRPC;
use Illuminate\Support\Facades\Facade;

/**
 * @method static mixed call(string $method, array $params = null)
 * @method static Gethrpc debug()
 * @method static Gethrpc ignoreSSL()
 * @method static Gethrpc setTimeout(int $connectTimeout, ?int $timeOut = null)
 * @method static Gethrpc setNoncePrefix(string $prefix)
 * @method static Gethrpc httpAuthBasic(string $user, string $pass)
 * @method static Gethrpc crossCheckReqIds(bool $trigger)
 * @method static int eth_blockNumber()
 * @method static string eth_getBalance(string $accountId, string $scope = "latest")
 *
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