<?php

namespace App\Domain;

use Money\Money;

class Product implements ISellable
{
    private ProductName $name;

    private Money $price;

    public function __construct(ProductName $name, Money $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function getName(): ProductName
    {
        return $this->name;
    }

    public function getPrice(): Money
    {
        return $this->price;
    }

}