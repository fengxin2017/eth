<?php

namespace Fengxin2017\ETH\Coin;

use Fengxin2017\ETH\Exception\InvalidAccountException;
use Fengxin2017\ETH\Exception\TransactionException;
use Fengxin2017\ETH\Facades\Eth as EthFacade;
use Fengxin2017\ETH\Facades\Geth;
use FurqanSiddiqui\Ethereum\Accounts\Account;
use Illuminate\Support\Str;
use Exception;


/**
 * @method self from($from)
 * @method self to($to)
 * @method self password(string $password)
 * @method self amountForHumans(string $amount)
 * @method self amount(string $amount)
 * @method self send()
 *
 * Class ETH
 */
class ETH
{
    /**
     * @var Account|null
     */
    protected ?Account $from = null;

    /**
     * @var Account|null
     */
    protected ?Account $to = null;

    /**
     * @var string|null
     */
    protected ?string $transactionPassword = null;

    /**
     * @var string|null
     */
    protected ?string $amount = null;


    /**
     * @return static
     */
    public static function getInstance(): self
    {
        return new static();
    }

    /**
     * @param Account|string $from
     * @return $this
     * @throws InvalidAccountException
     */
    protected function _from($from): self
    {
        if (is_string($from)) {
            $this->from = EthFacade::getAccount($from);
            return $this;
        }

        if ($from instanceof Account) {
            $this->from = $from;
            return $this;
        }

        throw new InvalidAccountException(sprintf('{from} should instanceof %s or be string', Account::class));
    }

    /**
     * @param Account|string $to
     * @return $this
     * @throws InvalidAccountException
     */
    protected function _to($to): self
    {
        if (is_string($to)) {
            $this->to = EthFacade::getAccount($to);
            return $this;
        }

        if ($to instanceof Account) {
            $this->to = $to;
            return $this;
        }

        throw new InvalidAccountException(sprintf('{to} should instanceof %s or be string', Account::class));
    }

    /**
     * @param string $amount
     * @return $this
     */
    protected function _amountForHumans(string $amount): self
    {
        $this->amount = sprintf('0x%s', base_convert(toWei($amount), 10, 16));
        return $this;
    }

    /**
     * @param string $amount
     * @return $this
     */
    protected function _amount(string $amount): self
    {
        if (Str::startsWith($amount, '0x')) {
            $this->amount = $amount;
            return $this;
        }

        $this->amount = sprintf('0x%s', base_convert($amount, 10, 16));
        return $this;
    }

    /**
     * @param string $password
     * @return $this
     */
    protected function _password(string $password): self
    {
        $this->transactionPassword = $password;
        return $this;
    }

    /**
     * @return mixed
     * @throws TransactionException
     */
    protected function _send()
    {
        if (true === $this->transactionValidateFailed()) {
            throw new TransactionException('from|to|amount|password can not be NULL');
        }

        return Geth::call('personal_sendTransaction', [$this->buildTransactionParams(), $this->transactionPassword]);
    }

    /**
     * @return bool
     */
    protected function transactionValidateFailed(): bool
    {
        return is_null($this->from) || is_null($this->to) || is_null($this->amount) || is_null($this->transactionPassword);
    }

    /**
     * @return array
     */
    protected function buildTransactionParams(): array
    {
        return [
            'from' => $this->from->getAddress(),
            'to' => $this->to->getAddress(),
            'value' => $this->amount
        ];
    }

    /**
     * @param string $method
     * @param array $parameters
     * @return mixed
     * @throws Exception
     */
    public function __call(string $method, array $parameters)
    {
        if (method_exists($this, $method = '_' . $method)) {
            return call_user_func_array([$this, $method], $parameters);
        }

        throw new Exception(sprintf('Method[%s] not exist', $method));
    }

    /**
     * @param string $method
     * @param array $parameters
     * @return mixed
     * @throws Exception
     */
    public static function __callStatic(string $method, array $parameters)
    {
        if (method_exists($object = new static(), $method = '_' . $method)) {
            return call_user_func_array([$object, $method], $parameters);
        }

        throw new Exception(sprintf('Method[%s] not exist', $method));
    }
}
