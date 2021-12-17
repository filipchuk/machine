<?php

namespace App\Domain;

use App\Domain\Exceptions\NotEnoughFundsException;
use Money\Money;

class Machine
{
    /**
     * @var Coins
     */
    private Coins $coins;

    public function __construct(Coins $coins)
    {
        $this->coins = $coins;
    }

    public function sell(ISellable $item, Payment $payment): SellChange
    {
        $paymentAllowed = new Payment($payment->getCoins()->filter($this->coins));
        $paymentAmount = $paymentAllowed->getAmount();

        $itemPrice = $item->getPrice();
        if ($paymentAmount->lessThan($itemPrice)) {
            throw new NotEnoughFundsException();
        }

        $change = $paymentAmount->subtract($itemPrice);
        $zero = Money::USD(0);

        $changeCoins = [];


        if ($change->greaterThan($zero)) {
            foreach ($this->coins->get() as $coin) {
                $coinsQty = floor($change->ratioOf($coin->getAmount()));

                if ($coinsQty > 0) {
                    for ($i = 0; $i < $coinsQty; $i++) {
                        $coinAmount = $coin->getAmount();
                        $changeCoin = new Coin($coinAmount);
                        $change = $change->subtract($coinAmount);
                        $changeCoins[] = $changeCoin;
                    }
                    if ($change->equals($zero)) {
                        break;
                    }
                }
            }
        }

        return new SellChange(new Coins($changeCoins));
    }

}