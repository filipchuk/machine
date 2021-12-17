<?php

namespace App\Domain;

class MachineService
{
    private ProductService $productService;
    private CoinsService $coinsService;

    public function __construct(
        ProductService $productService,
        CoinsService $coinsService
    ) {
        $this->productService = $productService;
        $this->coinsService = $coinsService;
    }

    /**
     * @throws Exceptions\NotEnoughFundsException|Exceptions\ProductNotFoundException
     */
    public function sell(string $productName, Payment $payment): SellChange
    {
        $allowedCoins = $this->coinsService->getAllowedCoins();
        $product = $this->productService->getByName($productName);

        $machine = new Machine($allowedCoins);

        return $machine->sell($product, $payment);
    }

}