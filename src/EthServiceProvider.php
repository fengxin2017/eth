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
    /**
     * @var string
     */
    protected static string $namespace = 'Fengxin2017\\Eth\\Erc20Tokens';

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

    protected function prependToLoaderStack()
    {
        spl_autoload_register([$this, 'loadErc20TokenFacacde'], true, true);
    }

    /**
     * @param string $token
     * @return bool|null
     */
    public function loadErc20TokenFacacde(string $token): ?bool
    {
        if (in_array($token, array_keys(config('eth.tokens')))) {
            require $this->ensureTokenExists($token, __DIR__ . '/../stubs/erc20Manager.stub');

            return true;
        }

        if (static::$namespace && strpos($token, static::$namespace) === 0) {
            require $this->ensureTokenExists($token, __DIR__ . '/../stubs/erc20.stub');

            return true;
        }
        return null;
    }

    /**
     * @param string $token
     * @return string
     */
    protected function ensureTokenExists(string $token, string $stubPath): string
    {
        if (is_file($path = storage_path('framework/cache/facade-' . sha1($token) . '.php'))) {
            return $path;
        }

        file_put_contents($path, $this->formatTokenStub(
            $token, file_get_contents($stubPath)
        ));

        return $path;
    }

    /**
     * @param string $token
     * @param string $stub
     * @return string
     */
    protected function formatTokenStub(string $token, string $stub): string
    {
        return str_replace('Erc20TokenName', class_basename($token), $stub);
    }

    public function boot()
    {
        if ($this->app->runningInConsole() && function_exists('config_path')) {
            $this->publishes([
                __DIR__ . '/../config/eth.php' => config_path('eth.php'),
            ], 'config');
        }

        $this->mergeConfigFrom(__DIR__ . '/../config/eth.php', 'eth');

        $this->prependToLoaderStack();
    }
}
