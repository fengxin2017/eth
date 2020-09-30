<?php

namespace Fengxin2017\ETH;

use FurqanSiddiqui\Ethereum\ERC20\ERC20;
use FurqanSiddiqui\Ethereum\Ethereum;
use FurqanSiddiqui\Ethereum\RPC\GethRPC;
use FurqanSiddiqui\Ethereum\RPC\InfuraAPI;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class EthServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerEth();
        $this->registerErc20();
        $this->registerGeth();
        $this->registerInfura();
    }

    protected function registerEth()
    {
        $this->app->singleton('eth', function (Application $app, $params) {
            return $app->make(Ethereum::class);
        });
    }

    protected function registerErc20()
    {
        $this->app->singleton('erc20', function (Application $app, $params) {
            return $app->make(ERC20::class, ['eth' => $app->make('eth')]);
        });
    }

    protected function registerInfura()
    {
        $this->app->singleton('infura', function (Application $app, $params) {
            return $app->make(InfuraAPI::class, [
                'eth' => $app->make('eth'),
                'projectId' => config('eth.infura.project_id'),
                'projectSecret' => config('eth.infura.project_secret'),
                'network' => config('eth.infura.network', 'mainnet'),
                'version' => config('eth.infura.version', 'v3')
            ]);
        });
    }

    protected function registerGeth()
    {
        $this->app->singleton('geth', function (Application $app, $params) {
            return $app->make(GethRPC::class, [
                'eth' => $app->make('eth'),
                'host' => config('eth.geth.host'),
                'port' => config('eth.geth.port')
            ]);
        });
    }

    public function boot()
    {
        if ($this->app->runningInConsole() && function_exists('config_path')) {
            $this->publishes([
                __DIR__ . '/../config/eth.php' => config_path('eth.php'),
            ], 'config');
        }

        $this->mergeConfigFrom(__DIR__ . '/../config/eth.php', 'eth');
    }
}
