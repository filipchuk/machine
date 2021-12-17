<?php

namespace App\Infrastructure;

use App\Domain\Coin;
use App\Domain\CoinsRepositoryInterface;
use Money\Money;

class CoinRepository implements CoinsRepositoryInterface
{

    public function getAll(): array
    {
        $config = [1, 2, 5, 10, 20, 50];

        return array_map(fn(int $value) => new Coin(Money::USD($value)), $config);
    }

}