<?php

namespace App\Domain;

use App\Domain\Exceptions\ProductNotFoundException;

interface ProductRepositoryInterface
{
    /**
     * @param string $name
     * @return Product
     * @throws ProductNotFoundException
     */
    public function getByName(string $name): Product;
}