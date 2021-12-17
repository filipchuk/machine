<?php

namespace App\Domain;

class ProductService
{
    private ProductRepositoryInterface $repository;

    /**
     * @param ProductRepositoryInterface $repository
     */
    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param $name
     * @return Product
     * @throws Exceptions\ProductNotFoundException
     */
    public function getByName($name): Product
    {
        return $this->repository->getByName($name);
    }
}