<?php

namespace App\Domain;

use Money\Money;

class PaymentRepository implements PaymentRepositoryInterface
{

    public function getPayment($input): Payment
    {
        if (is_string($input)) {
            $input = explode(' ', $input);
        }

        $items = array_map('intval', $input);
        $items = array_filter($items, fn(int $item) => $item > 0);

        $coins = array_map(fn($item) => new Coin(Money::USD($item)), $items);

        return new Payment(new Coins($coins));
    }

}