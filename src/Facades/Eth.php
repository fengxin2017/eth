<?php

namespace Fengxin2017\ETH\Facades;

use FurqanSiddiqui\Ethereum\Accounts\Account;
use FurqanSiddiqui\Ethereum\Contracts\ABI_Factory;
use FurqanSiddiqui\Ethereum\Ethereum;
use FurqanSiddiqui\Ethereum\KeyPair\HDFactory;
use FurqanSiddiqui\Ethereum\KeyPair\KeyPairFactory;
use FurqanSiddiqui\Ethereum\Math\WEIConverter;
use FurqanSiddiqui\Ethereum\Network\NetworkConfig;
use Illuminate\Support\Facades\Facade;

/**
 * @method static KeyPairFactory keyPairs()
 * @method static HDFactory hd()
 * @method static WEIConverter wei()
 * @method static Account getAccount(string $address)
 * @method static ABI_Factory contracts()
 * @method static NetworkConfig networkConfig()
 *
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
