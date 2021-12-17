<?php

namespace App\Domain;

class CoinsService
{
    public CoinsSortingInterface $sorting;
    private CoinsRepositoryInterface $repository;

    public function __construct(CoinsRepositoryInterface $repository, CoinsSortingInterface $sorting)
    {
        $this->repository = $repository;
        $this->sorting = $sorting;
    }

    public function getAllowedCoins(): Coins
    {
        $coins = $this->repository->getAll();
        usort($coins, function (Coin $a, Coin $b) {
            return $this->sorting->compare($a, $b);
        });

        return new Coins($coins);
    }


}