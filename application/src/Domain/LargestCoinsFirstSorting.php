<?php

namespace App\Domain;

class LargestCoinsFirstSorting implements CoinsSortingInterface
{
    public function compare(Coin $a, Coin $b): int
    {
        if ($a->getAmount()->lessThan($b->getAmount())) {
            return 1;
        }

        return -1;
    }
}