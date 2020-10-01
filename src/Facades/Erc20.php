<?php

namespace Fengxin2017\ETH\Facades;

use Fengxin2017\ETH\Erc20Manager;
use FurqanSiddiqui\Ethereum\ERC20\ERC20 as FurqanSiddiquiERC20;
use FurqanSiddiqui\Ethereum\ERC20\ERC20_Token;
use FurqanSiddiqui\Ethereum\RPC\AbstractRPCClient;
use Illuminate\Support\Facades\Facade;

/**
 * @method static ERC20_Token token($contractAddress)
 * @method static FurqanSiddiquiERC20 useRPCClient(AbstractRPCClient $rpcClient)
 *
 * @see FurqanSiddiquiERC20
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
