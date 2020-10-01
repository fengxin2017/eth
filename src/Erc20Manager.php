<?php

namespace Fengxin2017\ETH;

use FurqanSiddiqui\Ethereum\ERC20\ERC20 as FurqanSiddiquiERC20;
use Illuminate\Support\Manager;

class Erc20Manager extends Manager
{
    /**
     * @return string
     */
    public function getDefaultDriver(): string
    {
        return $this->config->get('eth.rpc.default');
    }

    /**
     * @return FurqanSiddiquiERC20
     */
    public function createInfuraDriver(): FurqanSiddiquiERC20
    {
        return app('erc20')->useRPCClient(app('infura')->ignoreSSL());
    }

    /**
     * @return FurqanSiddiquiERC20
     */
    public function createGethDriver(): FurqanSiddiquiERC20
    {
        return app('erc20')->useRPCClient(app('geth'));
    }
}