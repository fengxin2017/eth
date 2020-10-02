<?php

if (!function_exists('toWei')) {
    /**
     * @param string $amount
     * @return string
     */
    function toWei(string $amount): string
    {
        return bcmul($amount, bcpow(10, 18));
    }
}

if (!function_exists('fromWei')) {
    /**
     * @param string $amount
     * @return string|null
     */
    function fromWei(string $amount): string
    {
        return bcdiv($amount, bcpow(10, 18));
    }
}
