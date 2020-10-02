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

`````

`````php

// transfer erc20token only support geth rpcclient

use FurqanSiddiqui\Ethereum\Accounts\Account;

Usdt::name();
Usdt::totalSupply();
Usdt::balanceOf(Account|ETHADDRESS);

YFI::name();
YFI::totalSupply();

YFII::balanceOf(Account|ETHADDRESS);

YFII::from(Account|ETHADDRESS)
    ->to(Account|ETHADDRESS)
    ->amount(amount) // wei
    ->password(password)
    ->send();

// more...add token to config/eth.php

`````

### More

[erc20-php](https://github.com/furqansiddiqui/erc20-php)
