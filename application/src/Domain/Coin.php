<?php

namespace App\Domain;

use Money\Money;

class Coin
{
    private Money $amount;

    /**
     * @param Money $amount
     */
    public function __construct(Money $amount)
    {
        $this->amount = $amount;
    }

    public function equal(self $coin): bool
    {
        return $this->getAmount()->equals($coin->getAmount());
    }

    public function getAmount(): Money
    {
        return $this->amount;
    }

}