### Prerequisites

* **PHP** >= 7.4+

### Installation

`composer require fengxin2017/eth`

`$ php artisan vendor:publish -provider="Fengxin2017\ETH\EthServiceProvider"`

### Demo
`````php
use Fengxin2017\ETH\Facades\Eth;

Usdt::name();
Usdt::totalSupply();
YFI::name();
YFI::totalSupply();
Usdt::balanceOf(ETHADDRESS);
YFII::balanceOf(ETHADDRESS);

# transfer should use geth rpcclient
YFII::from(eth_address)->to(eth_address)->amount(amount)->password(password)->send();
....

# add token to config.php whatever you like.

`````

### More

[erc20-php](https://github.com/furqansiddiqui/erc20-php)
