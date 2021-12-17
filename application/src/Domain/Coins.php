<?php

namespace App\Domain;

use Money\Money;

class Coins
{
    /**
     * @var array<Coin>
     */
    private array $coins;

    public function __construct(array $coins)
    {
        $this->coins = $coins;
    }

    public function getAmount(): Money
    {
        return array_reduce(
            $this->get(),
            fn(Money $total, Coin $item) => $total->add($item->getAmount()),
            Money::USD(0)
        );
    }

    /**
     * @return Coin[]
     */
    public function get(): array
    {
        return $this->coins;
    }

    public function filter(self $allowed): self
    {
        $coins = $this->get();
        $allowedCoins = $allowed->get();

        $result = array_filter($coins, function (Coin $coin) use ($allowedCoins) {
            foreach ($allowedCoins as $allowedCoin) {
                if ($allowedCoin->equal($coin)) {
                    return true;
                }
            }

            return false;
        });

        return new self($result);
    }


}