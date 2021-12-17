<?php

namespace App\Domain;

use Money\Money;

class Payment
{
    private Coins $coins;

    public function __construct(Coins $coins)
    {
        $this->coins = $coins;
    }

    public function getAmount(): Money
    {
        return $this->getCoins()->getAmount();
    }

    public function getCoins(): Coins
    {
        return $this->coins;
    }
}