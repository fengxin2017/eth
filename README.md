### description
Ethereum API For Laravel

### Prerequisites

* **PHP** >= 7.4+

### Installation

`composer require fengxin2017/eth`

`$ php artisan vendor:publish -provider="Fengxin2017\ETH\EthServiceProvider"`

### Demo
`````php
// transfer ETH only support geth rpcclient.

use FurqanSiddiqui\Ethereum\Accounts\Account;
use Fengxin2017\ETH\Coin\ETH;

ETH::getInstance()->from(Account|ETHADDRESS)
        ->to(Account|ETHADDRESS)
        ->amount('0x9184e72a') // hex
        ->password('xxxx')
        ->send();

ETH::getInstance()->from(Account|ETHADDRESS)
        ->to(Account|ETHADDRESS)
        ->amount('100000000000') // wei
        ->password('xxxx')
        ->send();

ETH::from(Account|ETHADDRESS)
        ->to(Account|ETHADDRESS)
        ->amountForHumans(1)
        ->password('xxxx')
        ->send();
`````

`````php
use Fengxin2017\ETH\Facades\Geth;
use Fengxin2017\ETH\Facades\Infura;

Geth::eth_getBalance(ETHADDRESS);
Geth::eth_blockNumber();

Infura::eth_getBalance(ETHADDRESS);
Infura::eth_blockNumber();

// http://cw.hubwiz.com/card/c/ethereum-json-rpc-api/1/3/17/
// http://cw.hubwiz.com/card/c/geth-rpc-api/1/4/6/
Geth::call(METHOD_NAME,ARRAYPARAMS)

//https://infura.io/docs/ethereum/json-rpc
Infura::call(METHOD_NAME,ARRAYPARAMS)
`````

`````php
// transfer erc20token only support geth rpcclient

use FurqanSiddiqui\Ethereum\Accounts\Account;
use Fengxin2017\ETH\Facades\Erc20;

Usdt::name();
Usdt::totalSupply();
Usdt::balanceOf(Account|ETHADDRESS);

YFI::name();
YFI::totalSupply();

YFII::balanceOf(Account|ETHADDRESS);

YFII::from(Account|ETHADDRESS)
    ->to(Account|ETHADDRESS)
    ->amount(amount) 
    ->password(password)
    ->send();
.....


# OR

$usdt = Erc20::token(UsdtContractAddress);
$data = $usdt->encodedTransferData($to, $amount);
$params = [
    'from' => FROMADDRESS,
    'to' => USDTCONTRACTADDRESS,
    'value' => '0x0',
    'data' => $data
];
Geth::call('personal_sendTransaction', [
     $params, PASSWORD
]);

`````

### More

[erc20-php](https://github.com/furqansiddiqui/erc20-php)
