<?php

namespace Fengxin2017\ETH;

use Illuminate\Support\Manager;
use FurqanSiddiqui\Ethereum\ERC20\ERC20 as FurqanSiddiquiERC20;

class Erc20Manager extends Manager
{
    /**
     * @return mixed|string
     */
    public function getDefaultDriver()
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
