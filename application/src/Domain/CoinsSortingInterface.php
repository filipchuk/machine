<?php

namespace App\Domain;

interface CoinsSortingInterface
{
    public function compare(Coin $a, Coin $b): int;
}