<?php

namespace App\Infrastructure;

use App\Domain\Exceptions\ProductNotFoundException;
use App\Domain\Product;
use App\Domain\ProductName;
use App\Domain\ProductRepositoryInterface;
use Money\Money;

class ProductRepository implements ProductRepositoryInterface
{

    /**
     * @param $name
     * @return Product
     * @throws ProductNotFoundException
     */
    public function getByName($name): Product
    {
        $config = [
            'A' => 95,
            'B' => 126,
            'C' => 233,
        ];

        $productName = new ProductName($name);
        foreach ($config as $key => $price) {
            $existingProductName = new ProductName($key);
            if ($productName->equals($existingProductName)) {
                return new Product($existingProductName, Money::USD($price));
            }
        }
        throw new ProductNotFoundException();
    }

}