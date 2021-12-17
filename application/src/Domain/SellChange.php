<?php

namespace App\Domain;

class SellChange
{
    private Coins $coins;

    public function __construct(Coins $coins)
    {
        $this->coins = $coins;
    }

    public function getCoins(): Coins
    {
        return $this->coins;
    }
}